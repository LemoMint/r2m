<?php

namespace App\BlogPosts\Infrastructure\Repository;

use App\BlogPosts\Domain\Aggregate\BlogPostStatistics;
use App\BlogPosts\Domain\Repository\BlogPostStatisticsRepositoryInterface;
use App\Shared\Infrastructure\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\DocumentManager;

class BlogPostStatisticsRepository extends DocumentRepository implements BlogPostStatisticsRepositoryInterface
{
    public function __construct(DocumentManager $dm)
    {
        parent::__construct($dm, BlogPostStatistics::class);
    }
}