<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505081511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items ADD slot_id INT NOT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D59E5119C FOREIGN KEY (slot_id) REFERENCES slots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E11EE94D59E5119C ON items (slot_id)');
        $this->addSql('ALTER TABLE warrior ALTER coach_id DROP NOT NULL');
        $this->addSql('ALTER TABLE warrior ALTER strength DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE warrior ALTER coach_id SET NOT NULL');
        $this->addSql('ALTER TABLE warrior ALTER strength SET NOT NULL');
        $this->addSql('ALTER TABLE items DROP CONSTRAINT FK_E11EE94D59E5119C');
        $this->addSql('DROP INDEX IDX_E11EE94D59E5119C');
        $this->addSql('ALTER TABLE items DROP slot_id');
    }
}
