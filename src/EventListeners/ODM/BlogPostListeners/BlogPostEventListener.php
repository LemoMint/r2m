<?php

namespace App\EventListeners\ODM\BlogPostListeners;

use App\Document\BlogPost;
use App\Messenger\Messages\BlogPostCreatedMessage;
use Doctrine\Bundle\MongoDBBundle\Attribute\AsDocumentListener;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsDocumentListener(event: Events::postPersist)]
readonly class BlogPostEventListener
{
    public function __construct(
        private MessageBusInterface $bus
    )
    {
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $document = $args->getDocument();
        if ($document instanceof BlogPost) {
            $this->bus->dispatch(
                new BlogPostCreatedMessage(
                    $document->getUlid(),
                    $document->getBody()
                )
            );
        }
    }
}