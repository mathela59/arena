<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502163251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE warrior_skills DROP CONSTRAINT fk_12704e6f7ff61858');
        $this->addSql('DROP SEQUENCE skills_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, slot_id INT NOT NULL, warrior_id INT DEFAULT NULL, item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D338D58359E5119C ON equipment (slot_id)');
        $this->addSql('CREATE INDEX IDX_D338D583452AFEA4 ON equipment (warrior_id)');
        $this->addSql('CREATE INDEX IDX_D338D583126F525E ON equipment (item_id)');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers TEXT NOT NULL, requirements TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN items.modifiers IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN items.requirements IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58359E5119C FOREIGN KEY (slot_id) REFERENCES slots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583126F525E FOREIGN KEY (item_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE warrior_skills');
        $this->addSql('DROP TABLE skills');
        $this->addSql('ALTER TABLE fight_style DROP requirements');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers TYPE TEXT');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers DROP DEFAULT');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN fight_style.modifiers IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT fk_2e47a14b17b98b4c');
        $this->addSql('DROP INDEX idx_2e47a14b17b98b4c');
        $this->addSql('ALTER TABLE warrior ADD speed INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD dexterity INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD constitution INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD intelligence INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD will INT NOT NULL');
        $this->addSql('ALTER TABLE warrior RENAME COLUMN fight_style_id TO strength');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583126F525E');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE warrior_skills (warrior_id INT NOT NULL, skills_id INT NOT NULL, PRIMARY KEY(warrior_id, skills_id))');
        $this->addSql('CREATE INDEX idx_12704e6f7ff61858 ON warrior_skills (skills_id)');
        $this->addSql('CREATE INDEX idx_12704e6f452afea4 ON warrior_skills (warrior_id)');
        $this->addSql('CREATE TABLE skills (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, requirements JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE warrior_skills ADD CONSTRAINT fk_12704e6f452afea4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior_skills ADD CONSTRAINT fk_12704e6f7ff61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE items');
        $this->addSql('ALTER TABLE warrior ADD fight_style_id INT NOT NULL');
        $this->addSql('ALTER TABLE warrior DROP strength');
        $this->addSql('ALTER TABLE warrior DROP speed');
        $this->addSql('ALTER TABLE warrior DROP dexterity');
        $this->addSql('ALTER TABLE warrior DROP constitution');
        $this->addSql('ALTER TABLE warrior DROP intelligence');
        $this->addSql('ALTER TABLE warrior DROP will');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT fk_2e47a14b17b98b4c FOREIGN KEY (fight_style_id) REFERENCES fight_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2e47a14b17b98b4c ON warrior (fight_style_id)');
        $this->addSql('ALTER TABLE fight_style ADD requirements JSON NOT NULL');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers TYPE JSON');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers DROP DEFAULT');
        $this->addSql('ALTER TABLE fight_style ALTER modifiers SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN fight_style.modifiers IS NULL');
    }
}
