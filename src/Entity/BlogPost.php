<?php

namespace App\Entity;

use App\Service\UlidService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class BlogPost
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'string', options: ['unsigned' => true])]
    private readonly string $ulid;

    #[ORM\Column(type: 'string', length: 255)]
    private string $body;

    public function __construct(
        string $body,
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

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}