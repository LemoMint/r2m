<?php

namespace App\BlogPosts\Application\DTO;

use App\Shared\Application\DTO\RequestDtoInterface;

class CreateBlogPostActionRequest implements RequestDtoInterface
{
    public function __construct(
        public readonly string $body
    )
    {
    }
}