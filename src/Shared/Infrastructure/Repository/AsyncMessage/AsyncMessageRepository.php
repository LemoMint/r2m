<?php

namespace App\Shared\Infrastructure\Repository\AsyncMessage;

use App\Shared\Domain\Aggregate\AsyncMessage\AsyncMessage;
use App\Shared\Domain\Aggregate\AsyncMessage\AsyncMessageId;
use App\Shared\Domain\Repository\AsyncMessage\AsyncMessageRepositoryInterface;
use App\Shared\Infrastructure\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AsyncMessageRepository extends EntityRepository implements AsyncMessageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AsyncMessage::class);

    }

    public function nextIdentity(): AsyncMessageId
    {
        return AsyncMessageId::create();
    }
}