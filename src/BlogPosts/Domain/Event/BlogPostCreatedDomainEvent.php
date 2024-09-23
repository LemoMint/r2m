<?php

namespace App\BlogPosts\Domain\Event;

use App\Shared\Domain\Event\DomainEventInterface;

readonly class BlogPostCreatedDomainEvent implements DomainEventInterface
{
    public function __construct(
        public readonly string $blogPostUlid,
    )
    {
    }
}