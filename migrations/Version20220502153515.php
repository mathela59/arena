<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502153515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN breed.modifiers IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE warrior_breed (warrior_id INT NOT NULL, breed_id INT NOT NULL, PRIMARY KEY(warrior_id, breed_id))');
        $this->addSql('CREATE INDEX IDX_6E5F2334452AFEA4 ON warrior_breed (warrior_id)');
        $this->addSql('CREATE INDEX IDX_6E5F2334A8B4A30F ON warrior_breed (breed_id)');
        $this->addSql('ALTER TABLE warrior_breed ADD CONSTRAINT FK_6E5F2334452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_breed ADD CONSTRAINT FK_6E5F2334A8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE warrior_breed DROP CONSTRAINT FK_6E5F2334A8B4A30F');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE warrior_breed');
    }
}
