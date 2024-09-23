<?php

namespace App\Shared\Application\Event;

use App\Shared\Domain\Event\DomainEventInterface;

interface EventBusInterface
{
    public function execute(DomainEventInterface ...$events): void;
}