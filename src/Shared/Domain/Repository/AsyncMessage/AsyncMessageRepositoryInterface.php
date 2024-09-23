<?php

namespace App\Shared\Domain\Repository\AsyncMessage;

use App\Shared\Domain\Aggregate\AsyncMessage\AsyncMessageId;
use App\Shared\Domain\Repository\RepositoryInterface;

interface AsyncMessageRepositoryInterface extends RepositoryInterface
{
    public function nextIdentity(): AsyncMessageId;
}