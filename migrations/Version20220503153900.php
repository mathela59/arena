<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503153900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE combat (id INT NOT NULL, first_id INT NOT NULL, second_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D51E398E84D625F ON combat (first_id)');
        $this->addSql('CREATE INDEX IDX_8D51E398FF961BCC ON combat (second_id)');
        $this->addSql('CREATE TABLE combat_lines (id INT NOT NULL, combat_id INT NOT NULL, text VARCHAR(255) NOT NULL, sorting_key INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C124A93FFC7EEDB8 ON combat_lines (combat_id)');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, slot_id INT NOT NULL, warrior_id INT DEFAULT NULL, item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D338D58359E5119C ON equipment (slot_id)');
        $this->addSql('CREATE INDEX IDX_D338D583452AFEA4 ON equipment (warrior_id)');
        $this->addSql('CREATE INDEX IDX_D338D583126F525E ON equipment (item_id)');
        $this->addSql('CREATE TABLE fight_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, requirements JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, fight_style_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D664ED517B98B4C ON sentence (fight_style_id)');
        $this->addSql('CREATE TABLE skills (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE slots (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE traits (id INT NOT NULL, name VARCHAR(255) NOT NULL, short_code VARCHAR(3) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE warrior (id INT NOT NULL, coach_id INT NOT NULL, breed_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, experience INT NOT NULL, strength INT NOT NULL, speed INT NOT NULL, dexterity INT NOT NULL, constitution INT NOT NULL, intelligence INT NOT NULL, will INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E47A14B3C105691 ON warrior (coach_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14BA8B4A30F ON warrior (breed_id)');
        $this->addSql('CREATE TABLE warrior_traits (warrior_id INT NOT NULL, traits_id INT NOT NULL, PRIMARY KEY(warrior_id, traits_id))');
        $this->addSql('CREATE INDEX IDX_23E1F979452AFEA4 ON warrior_traits (warrior_id)');
        $this->addSql('CREATE INDEX IDX_23E1F9794BD15C06 ON warrior_traits (traits_id)');
        $this->addSql('CREATE TABLE warrior_slots (warrior_id INT NOT NULL, slots_id INT NOT NULL, PRIMARY KEY(warrior_id, slots_id))');
        $this->addSql('CREATE INDEX IDX_5E849EAB452AFEA4 ON warrior_slots (warrior_id)');
        $this->addSql('CREATE INDEX IDX_5E849EAB1E91875B ON warrior_slots (slots_id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398E84D625F FOREIGN KEY (first_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398FF961BCC FOREIGN KEY (second_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_lines ADD CONSTRAINT FK_C124A93FFC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58359E5119C FOREIGN KEY (slot_id) REFERENCES slots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583126F525E FOREIGN KEY (item_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED517B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B3C105691 FOREIGN KEY (coach_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('ALTER TABLE combat_lines DROP CONSTRAINT FK_C124A93FFC7EEDB8');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED517B98B4C');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583126F525E');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D58359E5119C');
        $this->addSql('ALTER TABLE warrior_slots DROP CONSTRAINT FK_5E849EAB1E91875B');
        $this->addSql('ALTER TABLE warrior_traits DROP CONSTRAINT FK_23E1F9794BD15C06');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B3C105691');
        $this->addSql('ALTER TABLE combat DROP CONSTRAINT FK_8D51E398E84D625F');
        $this->addSql('ALTER TABLE combat DROP CONSTRAINT FK_8D51E398FF961BCC');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583452AFEA4');
        $this->addSql('ALTER TABLE warrior_traits DROP CONSTRAINT FK_23E1F979452AFEA4');
        $this->addSql('ALTER TABLE warrior_slots DROP CONSTRAINT FK_5E849EAB452AFEA4');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE combat_lines');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE fight_style');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE sentence');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE slots');
        $this->addSql('DROP TABLE traits');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE warrior');
        $this->addSql('DROP TABLE warrior_traits');
        $this->addSql('DROP TABLE warrior_slots');
    }
}
