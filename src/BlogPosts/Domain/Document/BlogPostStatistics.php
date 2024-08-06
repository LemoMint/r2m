<?php

namespace App\BlogPosts\Domain\Document;

class BlogPostStatistics
{
    private \DateTime $createdAt;

    public function __construct(
        private string $ulid
    )
    {
        $this->createdAt = new \DateTime();
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}