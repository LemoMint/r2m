<?php

namespace App\BlogPosts\Application\Command\PostAction;

use App\BlogPosts\Domain\Entity\BlogPost;
use App\BlogPosts\Domain\Repository\BlogPostRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class PostActionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly BlogPostRepositoryInterface $blogPostRepository
    )
    {
    }

    public function __invoke(PostActionCommand $command): void
    {
        $blogPost = new BlogPost($command->body);

        $this->blogPostRepository->add($blogPost);
    }
}