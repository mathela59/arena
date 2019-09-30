<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927200148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fighting_style CHANGE modifiers modifiers VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sentences CHANGE style_id style_id INT DEFAULT NULL, CHANGE race_id race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE warrior CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fighting_style CHANGE modifiers modifiers VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sentences CHANGE style_id style_id INT DEFAULT NULL, CHANGE race_id race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE warrior CHANGE user_id user_id INT DEFAULT NULL');
    }
}
