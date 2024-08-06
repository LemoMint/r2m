<?php

namespace App\Messenger\Consumers;

use App\Entity\BlogPost;
use App\Messenger\Messages\BlogPostCreatedMessage;
use App\Repository\BlogPostRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
readonly class BlogPostCreatedMessageConsumer
{
    public function __construct(
        private BlogPostRepository $blogPostRepository
    )
    {
    }

    public function __invoke(BlogPostCreatedMessage $message): void
    {
        $blogPost = new BlogPost($message->getBody());
        $this->blogPostRepository->add($blogPost, true);
    }
}