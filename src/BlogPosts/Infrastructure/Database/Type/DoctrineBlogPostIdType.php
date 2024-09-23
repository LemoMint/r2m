<?php

namespace App\BlogPosts\Infrastructure\Database\Type;

use App\BlogPosts\Domain\Aggregate\BlogPost\BlogPostId;
use App\Shared\Domain\Aggregate\Id;
use App\Shared\Infrastructure\Database\Type\IdType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DoctrineBlogPostIdType extends IdType
{
    protected function doConvertToPHPValue($value, AbstractPlatform $platform): Id
    {
        return BlogPostId::create($value);
    }

    protected function getTypeName(): string
    {
        return 'blog_post_id';
    }
}