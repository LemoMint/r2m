<?php

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Service\UlidService;

class Id
{
    protected mixed $id;
    protected function __construct($anId = null)
    {
        $this->id = $anId ?: UlidService::generateUlid();
    }

    public function id()
    {
        return $this->id;
    }

    public static function create($anId = null): static
    {
        return new static($anId);
    }

    public function __toString(): string
    {
        return $this->id;
    }
}