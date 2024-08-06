<?php

namespace App\Shared\Domain\Repository;

interface AbstractRepositoryInterface
{
    public function findOneById(int $id): ?object;

    public function add($entity, bool $flush = false): void;

    public function remove($entity, bool $flush = false): void;

    public function findAll();
}