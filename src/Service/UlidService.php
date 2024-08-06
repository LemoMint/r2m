<?php

namespace App\Service;

use Symfony\Component\Uid\Ulid;

class UlidService
{
    public static function generateUlid(): string
    {
        return Ulid::generate();
    }
}