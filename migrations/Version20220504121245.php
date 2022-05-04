<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504121245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE warrior ADD fight_style_id INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B17B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2E47A14B17B98B4C ON warrior (fight_style_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B17B98B4C');
        $this->addSql('DROP INDEX IDX_2E47A14B17B98B4C');
        $this->addSql('ALTER TABLE warrior DROP fight_style_id');
    }
}
