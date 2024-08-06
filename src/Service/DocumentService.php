<?php

namespace App\Service;

use App\Document\BlogPost;
use Doctrine\ODM\MongoDB\DocumentManager;

readonly class DocumentService
{
    public function __construct(
        private DocumentManager $dm
    )
    {
    }

    public function createBlogPost(string $body): BlogPost
    {
        $post = new BlogPost($body);
        $this->dm->persist($post);
        $this->dm->flush();

        return $post;
    }
}