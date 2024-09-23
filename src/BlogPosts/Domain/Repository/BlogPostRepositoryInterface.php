<?php

namespace App\BlogPosts\Domain\Repository;

use App\BlogPosts\Domain\Aggregate\BlogPost\BlogPostId;
use App\Shared\Domain\Repository\RepositoryInterface;

interface BlogPostRepositoryInterface extends RepositoryInterface
{
    public function nextIdentity(): BlogPostId;
}