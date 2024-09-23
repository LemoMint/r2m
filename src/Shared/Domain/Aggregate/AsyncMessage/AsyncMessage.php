<?php

namespace App\Shared\Domain\Aggregate\AsyncMessage;

use App\Shared\Domain\Aggregate\Aggregate;
use App\Shared\Domain\Event\DomainEventInterface;

class AsyncMessage extends Aggregate
{
    private function __construct(
        private readonly AsyncMessageId $ulid,
        private readonly string         $body,
        private readonly string         $messageClass
    )
    {
    }

    public static function writeNewFrom(
        AsyncMessageId $id,
        string         $body,
        string         $messageClass,
    ): static
    {
        return new static($id, $body, $messageClass);
    }

    private function getMessage(): DomainEventInterface
    {
        return new $this->messageClass($this->body);
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function messageCreated(): void
    {
        $this->raise($this->getMessage());
    }
}