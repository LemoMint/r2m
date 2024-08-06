<?php

namespace App\Document;

use App\Service\UlidService;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(collection: 'blog_posts')]
class BlogPost
{
    #[ODM\Id(strategy: "NONE")]
    private ?string $ulid = null;

    #[ODM\Field(type: "string")]
    private string $body;

    public function __construct(
        string $body
    )
    {
        $this->ulid = UlidService::generateUlid();
        $this->body = $body;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}