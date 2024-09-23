<?php

namespace App\Shared\Infrastructure\Database\Type;

use App\Shared\Domain\Aggregate\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

abstract class IdType extends GuidType
{
    /**
     * @param Id $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->id();
    }
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $this->doConvertToPHPValue($value, $platform);
    }

    public function getName(): string
    {
        return $this->getTypeName();
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'VARCHAR(26)';
    }

    protected abstract function doConvertToPHPValue($value, AbstractPlatform $platform): Id;
    protected abstract function getTypeName(): string;
}