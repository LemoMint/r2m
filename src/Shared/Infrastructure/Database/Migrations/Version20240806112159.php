<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240806112159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE blog_posts (ulid VARCHAR(26) NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(ulid))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE blog_posts');
    }
}
