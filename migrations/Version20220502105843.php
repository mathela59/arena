<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502105843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fight_style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slots_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE traits_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE warrior_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fight_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, requirements JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skills (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, requirements JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE slots (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE traits (id INT NOT NULL, name VARCHAR(255) NOT NULL, short_code VARCHAR(3) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE warrior (id INT NOT NULL, coach_id INT NOT NULL, fight_style_id INT NOT NULL, breed_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, experience INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E47A14B3C105691 ON warrior (coach_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14B17B98B4C ON warrior (fight_style_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14BA8B4A30F ON warrior (breed_id)');
        $this->addSql('CREATE TABLE warrior_skills (warrior_id INT NOT NULL, skills_id INT NOT NULL, PRIMARY KEY(warrior_id, skills_id))');
        $this->addSql('CREATE INDEX IDX_12704E6F452AFEA4 ON warrior_skills (warrior_id)');
        $this->addSql('CREATE INDEX IDX_12704E6F7FF61858 ON warrior_skills (skills_id)');
        $this->addSql('CREATE TABLE warrior_traits (warrior_id INT NOT NULL, traits_id INT NOT NULL, PRIMARY KEY(warrior_id, traits_id))');
        $this->addSql('CREATE INDEX IDX_23E1F979452AFEA4 ON warrior_traits (warrior_id)');
        $this->addSql('CREATE INDEX IDX_23E1F9794BD15C06 ON warrior_traits (traits_id)');
        $this->addSql('CREATE TABLE warrior_slots (warrior_id INT NOT NULL, slots_id INT NOT NULL, PRIMARY KEY(warrior_id, slots_id))');
        $this->addSql('CREATE INDEX IDX_5E849EAB452AFEA4 ON warrior_slots (warrior_id)');
        $this->addSql('CREATE INDEX IDX_5E849EAB1E91875B ON warrior_slots (slots_id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B3C105691 FOREIGN KEY (coach_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B17B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_skills ADD CONSTRAINT FK_12704E6F452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_skills ADD CONSTRAINT FK_12704E6F7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_traits ADD CONSTRAINT FK_23E1F979452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_traits ADD CONSTRAINT FK_23E1F9794BD15C06 FOREIGN KEY (traits_id) REFERENCES traits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_slots ADD CONSTRAINT FK_5E849EAB452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_slots ADD CONSTRAINT FK_5E849EAB1E91875B FOREIGN KEY (slots_id) REFERENCES slots (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14BA8B4A30F');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B17B98B4C');
        $this->addSql('ALTER TABLE warrior_skills DROP CONSTRAINT FK_12704E6F7FF61858');
        $this->addSql('ALTER TABLE warrior_slots DROP CONSTRAINT FK_5E849EAB1E91875B');
        $this->addSql('ALTER TABLE warrior_traits DROP CONSTRAINT FK_23E1F9794BD15C06');
        $this->addSql('ALTER TABLE warrior_skills DROP CONSTRAINT FK_12704E6F452AFEA4');
        $this->addSql('ALTER TABLE warrior_traits DROP CONSTRAINT FK_23E1F979452AFEA4');
        $this->addSql('ALTER TABLE warrior_slots DROP CONSTRAINT FK_5E849EAB452AFEA4');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fight_style_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE skills_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slots_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE traits_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE warrior_id_seq CASCADE');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE fight_style');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE slots');
        $this->addSql('DROP TABLE traits');
        $this->addSql('DROP TABLE warrior');
        $this->addSql('DROP TABLE warrior_skills');
        $this->addSql('DROP TABLE warrior_traits');
        $this->addSql('DROP TABLE warrior_slots');
    }
}
