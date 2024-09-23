<?php

namespace App\Shared\Domain\Repository;

interface RepositoryInterface
{
    public function findOneByUlid(string $ulid): ?object;
    public function findAll();

    public function add($entity, bool $flush = false): void;

    public function remove($entity, bool $flush = false): void;
}