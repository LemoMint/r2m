<?php

namespace App\BlogPosts\Infrastructure\Repository;

use App\BlogPosts\Domain\Aggregate\BlogPost\BlogPost;
use App\BlogPosts\Domain\Aggregate\BlogPost\BlogPostId;
use App\BlogPosts\Domain\Repository\BlogPostRepositoryInterface;
use App\Shared\Infrastructure\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogPostRepository extends EntityRepository implements BlogPostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    public function nextIdentity(): BlogPostId
    {
        return BlogPostId::create();
    }
}