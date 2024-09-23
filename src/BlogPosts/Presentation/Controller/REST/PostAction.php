<?php

namespace App\BlogPosts\Presentation\Controller\REST;

use App\BlogPosts\Application\Command\PostAction\PostActionCommand;
use App\BlogPosts\Application\DTO\CreateBlogPostActionRequest;
use App\Shared\Application\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/posts", name: "blog_posts_create_action", methods: ['POST'])]
readonly class PostAction
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function __invoke(CreateBlogPostActionRequest $request): JsonResponse
    {
        $this->commandBus->execute(new PostActionCommand($request->body));

        return new JsonResponse(null, 201);
    }
}