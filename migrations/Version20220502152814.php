<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502152814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT fk_2e47a14ba8b4a30f');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP INDEX idx_2e47a14ba8b4a30f');
        $this->addSql('ALTER TABLE warrior DROP breed_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE warrior ADD breed_id INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT fk_2e47a14ba8b4a30f FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2e47a14ba8b4a30f ON warrior (breed_id)');
    }
}
