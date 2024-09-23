<?php

namespace App\BlogPosts\Presentation\Consumer;

use App\BlogPosts\Domain\Aggregate\BlogPostStatistics;
use App\BlogPosts\Domain\Event\BlogPostCreatedDomainEvent;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class BlogPostCreatedMessageConsumer
{
    public function __construct(
        private DocumentManager $dm
    )
    {
    }

    /**
     * @throws MongoDBException
     */
    public function __invoke(BlogPostCreatedDomainEvent $message): void
    {
        $blogPost = BlogPostStatistics::writeNewFrom($message->blogPostUlid);
        $this->dm->persist($blogPost);
        $this->dm->flush();
    }
}