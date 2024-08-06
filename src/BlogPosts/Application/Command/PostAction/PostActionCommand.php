<?php

namespace App\BlogPosts\Application\Command\PostAction;

use App\Shared\Application\Command\CommandInterface;

readonly class PostActionCommand implements CommandInterface
{
    public function __construct(
        public string $body
    )
    {
    }
}