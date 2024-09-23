<?php

namespace App\Shared\Infrastructure\Database\Type\AsyncMessage;

use App\Shared\Domain\Aggregate\AsyncMessage\AsyncMessageId;
use App\Shared\Domain\Aggregate\Id;
use App\Shared\Infrastructure\Database\Type\IdType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class AsyncMessageIdType extends IdType
{
    protected function doConvertToPHPValue($value, AbstractPlatform $platform): Id
    {
        return AsyncMessageId::create($value);
    }

    protected function getTypeName(): string
    {
        return 'async_message_id';
    }
}