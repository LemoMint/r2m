<?php

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Event\DomainEventInterface;

abstract class Aggregate
{
    /**
     * @var DomainEventInterface[]
     */
    private array $events;

    public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function eventsEmpty(): bool
    {
        return empty($this->events);
    }

    public function raise(DomainEventInterface $event): void
    {
        $this->events[] = $event;
    }
}