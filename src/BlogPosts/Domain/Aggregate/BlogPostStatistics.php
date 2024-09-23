<?php

namespace App\BlogPosts\Domain\Aggregate;

class BlogPostStatistics
{
    private \DateTime $createdAt;

    private function __construct(
        private string $ulid
    )
    {
        $this->createdAt = new \DateTime();
    }

    public static function writeNewFrom(
        string $ulid
    ): static
    {
        $blogPostStatistics = new static($ulid);
        return $blogPostStatistics;
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