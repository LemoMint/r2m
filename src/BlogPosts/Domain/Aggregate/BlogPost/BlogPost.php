<?php

namespace App\BlogPosts\Domain\Aggregate\BlogPost;

use App\Shared\Domain\Aggregate\Aggregate;

class BlogPost extends Aggregate
{
    private readonly BlogPostId $ulid;

    private string $body;

    private function __construct(
        BlogPostId $ulid,
        string $body,
    )
    {
        $this->ulid = $ulid;
        $this->body = $body;
    }

    public static function writeNewFrom(
        BlogPostId $ulid,
        string $body
    ): static
    {
        $blogPost = new static($ulid, $body);

        return $blogPost;
    }

    public function update(
        ?string $body = null
    ): self
    {
        $this->body = $body ?? $this->body;

        return $this;
    }

    public function getUlid(): BlogPostId
    {
        return $this->ulid;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}