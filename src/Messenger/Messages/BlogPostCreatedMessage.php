<?php

namespace App\Messenger\Messages;

readonly class BlogPostCreatedMessage
{
    public function __construct(
        private string $messageUlid,
        private string $body,
    )
    {
    }

    public function getMessageUlid(): string
    {
        return $this->messageUlid;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}