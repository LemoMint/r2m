<?php

namespace App\BlogPosts\Domain\Entity;

use App\BlogPosts\Domain\Event\BlogPostCreatedEvent;
use App\Shared\Domain\Aggregate;
use App\Shared\Domain\Service\UlidService;

class BlogPost extends Aggregate
{
    private readonly string $ulid;

    private string $body;

    public function __construct(
        string $body,
    )
    {
        $this->ulid = UlidService::generateUlid();
        $this->body = $body;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function blogPostCreated(): void
    {
        $this->raise(new BlogPostCreatedEvent($this->ulid));
    }
}