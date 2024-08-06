<?php

namespace App\BlogPosts\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

readonly class BlogPostCreatedEvent implements EventInterface
{
    public function __construct(
        private string $blogPostUlid,
    )
    {
    }

    public function getBlogPostUlid(): string
    {
        return $this->blogPostUlid;
    }
}