<?php

namespace App\BlogPosts\Application\Command\PostAction;

use App\BlogPosts\Domain\Aggregate\BlogPost\BlogPost;
use App\BlogPosts\Domain\Event\BlogPostCreatedDomainEvent;
use App\BlogPosts\Domain\Repository\BlogPostRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Aggregate\AsyncMessage\AsyncMessage;
use App\Shared\Domain\Repository\AsyncMessage\AsyncMessageRepositoryInterface;

readonly class PostActionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly BlogPostRepositoryInterface $blogPostRepository,
        private readonly AsyncMessageRepositoryInterface $asyncMessageRepository,
    )
    {
    }

    public function __invoke(PostActionCommand $command): string
    {
        $blogPost = BlogPost::writeNewFrom(
            $this->blogPostRepository->nextIdentity(),
            $command->body
        );
        $blogPostCreatedMessage = AsyncMessage::writeNewFrom(
            $this->asyncMessageRepository->nextIdentity(),
            json_encode($blogPost->getUlid()),
            BlogPostCreatedDomainEvent::class
        );

        $this->blogPostRepository->add($blogPost);
        $this->asyncMessageRepository->add($blogPostCreatedMessage);

        return $blogPost->getUlid()->id();
    }
}