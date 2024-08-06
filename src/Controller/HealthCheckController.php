<?php

namespace App\Controller;

use App\Service\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractController
{
    public function __construct(
        private readonly DocumentService $documentService
    )
    {
    }

    #[Route('/health/check', name: 'app_health_check')]
    public function index(): JsonResponse
    {
        return $this->json([
            'success' => true,
        ]);
    }

    #[Route('/api/post', name: 'blog_post_create', methods: ['POST'])]
    public function post(Request $request): JsonResponse
    {

        return new JsonResponse([
            $this->documentService->createBlogPost(json_decode($request->getContent(), true)['body'])
        ], 201);
    }
}
