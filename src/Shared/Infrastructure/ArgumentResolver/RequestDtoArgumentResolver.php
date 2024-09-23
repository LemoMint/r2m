<?php

namespace App\Shared\Infrastructure\ArgumentResolver;

use App\Shared\Application\DTO\RequestDtoInterface;
use App\Shared\Application\Exceptions\BadFileUploadException;
use ArgumentCountError;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

readonly final class RequestDtoArgumentResolver implements ValueResolverInterface
{
    private SerializerInterface $serializer;

    public function __construct(
    )
    {
        $encoders = [];
        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($argument->getType() === null) {
            return;
        }

        if ($this->supports($argument)) {
            $request = $this->createFromRequest($request, $argument);
        }


        yield $request;
    }

    private function supports(ArgumentMetadata $argument): bool
    {
        try {
            $reflection = new ReflectionClass($argument->getType());
        } catch (ReflectionException) {
            return false;
        }

        return $reflection->implementsInterface(RequestDtoInterface::class);
    }

    private function createFromRequest(Request $request, ArgumentMetadata $argument): RequestDtoInterface
    {
        $class = $argument->getType();
        try {
            $dto = $this->handleRequestData($request, $class);
        } catch (ArgumentCountError $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (BadFileUploadException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $dto;
    }

    /**
     * @throws BadFileUploadException
     */
    private function handleRequestData(Request $request, string $class): RequestDtoInterface
    {
        $requestData = array_merge(
            json_decode($request->getContent(), true) ?? [],
            $request->query->all(),
            $request->request->all(),
            $this->handleFiles($request->files->all()),
            $request->attributes->get('_route_params')
        );

        foreach ($requestData as $key => $value) {
            if (is_string($value) && is_array(json_decode($value, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                $requestData[$key] = json_decode($value, true);
            }

            if ($value === "true" || $value === "false") {
                $requestData[$key] = $value == "true";
            }
        }

        return $this->serializer->denormalize(
            $requestData,
            $class
        );
    }

    /**
     * @param UploadedFile[] $files
     *
     * @throws BadFileUploadException
     */
    private function handleFiles(array $files): array
    {
        foreach ($files as $k => $file) {
            if ($file->getError() === 0) {
                $files[$k] = [
                    "path" => $file->getPathname(),
                    "originalName" => $file->getClientOriginalName(),
                    "mimeType" => $file->getClientMimeType(),
                    "error" => $file->getError(),
                    "test" => $file->getMimeType() == 'application/x-empty',
                ];
            } else {
                throw new BadFileUploadException(sprintf("An error occurred while processing file %s", $file->getClientOriginalName()));
            }
        }

        return $files;
    }
}