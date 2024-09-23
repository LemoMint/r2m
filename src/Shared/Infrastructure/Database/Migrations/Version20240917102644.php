<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240917102644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_posts (ulid VARCHAR(26) NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('CREATE TABLE shared_messages_async (ulid VARCHAR(26) NOT NULL, body VARCHAR(255) NOT NULL, message_class VARCHAR(255) NOT NULL, PRIMARY KEY(ulid))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE blog_posts');
        $this->addSql('DROP TABLE shared_messages_async');
    }
}