<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506133008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE combat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE combat_lines_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fight_style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sentence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slots_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE traits_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE warrior_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
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
        $this->addSql('CREATE TABLE items (id INT NOT NULL, slot_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, requirements JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E11EE94D59E5119C ON items (slot_id)');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, fight_style_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, critic BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D664ED517B98B4C ON sentence (fight_style_id)');
        $this->addSql('CREATE TABLE skills (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE slots (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE traits (id INT NOT NULL, name VARCHAR(255) NOT NULL, short_code VARCHAR(3) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE warrior (id INT NOT NULL, coach_id INT DEFAULT NULL, fight_style_id INT NOT NULL, breed_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, experience INT NOT NULL, strength INT DEFAULT NULL, speed INT NOT NULL, dexterity INT NOT NULL, constitution INT NOT NULL, intelligence INT NOT NULL, will INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E47A14B3C105691 ON warrior (coach_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14B17B98B4C ON warrior (fight_style_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14BA8B4A30F ON warrior (breed_id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398E84D625F FOREIGN KEY (first_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398FF961BCC FOREIGN KEY (second_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_lines ADD CONSTRAINT FK_C124A93FFC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58359E5119C FOREIGN KEY (slot_id) REFERENCES slots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583126F525E FOREIGN KEY (item_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D59E5119C FOREIGN KEY (slot_id) REFERENCES slots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED517B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B3C105691 FOREIGN KEY (coach_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B17B98B4C FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14BA8B4A30F');
        $this->addSql('ALTER TABLE combat_lines DROP CONSTRAINT FK_C124A93FFC7EEDB8');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED517B98B4C');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B17B98B4C');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583126F525E');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D58359E5119C');
        $this->addSql('ALTER TABLE items DROP CONSTRAINT FK_E11EE94D59E5119C');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B3C105691');
        $this->addSql('ALTER TABLE combat DROP CONSTRAINT FK_8D51E398E84D625F');
        $this->addSql('ALTER TABLE combat DROP CONSTRAINT FK_8D51E398FF961BCC');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583452AFEA4');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE combat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE combat_lines_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fight_style_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sentence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE skills_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slots_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE traits_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE warrior_id_seq CASCADE');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE combat_lines');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE fight_style');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE sentence');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE slots');
        $this->addSql('DROP TABLE traits');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE warrior');
    }
}
