<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502165414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE combat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE combat_lines_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sentence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE combat (id INT NOT NULL, first_id INT NOT NULL, second_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D51E398E84D625F ON combat (first_id)');
        $this->addSql('CREATE INDEX IDX_8D51E398FF961BCC ON combat (second_id)');
        $this->addSql('CREATE TABLE combat_lines (id INT NOT NULL, combat_id INT NOT NULL, text VARCHAR(255) NOT NULL, sorting_key INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C124A93FFC7EEDB8 ON combat_lines (combat_id)');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, fight_style_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D664ED517B98B4C ON sentence (fight_style_id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398E84D625F FOREIGN KEY (first_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398FF961BCC FOREIGN KEY (second_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_lines ADD CONSTRAINT FK_C124A93FFC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED517B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE combat_lines DROP CONSTRAINT FK_C124A93FFC7EEDB8');
        $this->addSql('DROP SEQUENCE combat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE combat_lines_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sentence_id_seq CASCADE');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE combat_lines');
        $this->addSql('DROP TABLE sentence');
    }
}
