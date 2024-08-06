<?php

namespace App\BlogPosts\Infrastructure\Repository;

use App\BlogPosts\Domain\Entity\BlogPost;
use App\BlogPosts\Domain\Repository\BlogPostRepositoryInterface;
use App\Shared\Infrastructure\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogPostRepository extends AbstractRepository implements BlogPostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }
}