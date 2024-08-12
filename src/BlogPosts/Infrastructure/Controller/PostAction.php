<?php

namespace App\BlogPosts\Infrastructure\Controller;

use App\BlogPosts\Application\Command\PostAction\PostActionCommand;
use App\Shared\Application\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/posts", name: "blog_posts_create_action", methods: ['POST'])]
class PostAction
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->commandBus->execute(new PostActionCommand(json_decode($request->getContent(), true)['body']));

        return new JsonResponse(null, 201);
    }
}