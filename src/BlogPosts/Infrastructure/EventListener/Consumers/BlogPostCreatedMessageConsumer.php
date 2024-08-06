<?php

namespace App\BlogPosts\Infrastructure\EventListener\Consumers;

use App\BlogPosts\Domain\Document\BlogPostStatistics;
use App\BlogPosts\Domain\Event\BlogPostCreatedEvent;
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
    public function __invoke(BlogPostCreatedEvent $message): void
    {
        $blogPost = new BlogPostStatistics($message->getBlogPostUlid());
        $this->dm->persist($blogPost);
        $this->dm->flush();
    }
}