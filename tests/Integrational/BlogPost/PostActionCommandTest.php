<?php

namespace App\Tests\Integrational\BlogPost;

use App\BlogPosts\Application\Command\PostAction\PostActionCommand;
use App\BlogPosts\Domain\Repository\BlogPostRepositoryInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\Helper\FakerHelper;
use App\Tests\Helper\DoctrineTransactionRollbackHelper;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostActionCommandTest extends KernelTestCase
{
    use FakerHelper;
    use DoctrineTransactionRollbackHelper;

    private readonly Generator $faker;
    private readonly BlogPostRepositoryInterface $blogPostRepository;
    private CommandBusInterface $commandBus;

    public function setUp(): void
    {
        $this->blogPostRepository = $this->getService(BlogPostRepositoryInterface::class);
        $this->commandBus = $this->getService(CommandBusInterface::class);
        $this->faker = $this->getFaker();
    }

    public function test_blog_post_created(): void
    {
        //Arrange
        $command = new PostActionCommand($this->faker->word());

        //Act
        $blogPostFromCommandUlid = $this->commandBus->execute($command);

        //Assert
        $realBlogPost = $this->blogPostRepository->findOneByUlid($blogPostFromCommandUlid);
        $this->assertNotNull($realBlogPost);
        $this->assertEquals($blogPostFromCommandUlid, $realBlogPost->getUlid());
    }
}