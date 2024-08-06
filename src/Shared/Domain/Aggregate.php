<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Event\EventInterface;

class Aggregate
{
    /**
     * @var EventInterface[]
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

    public function raise(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}