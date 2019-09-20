<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190920131938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE combat_line (id INT AUTO_INCREMENT NOT NULL, combat_id INT NOT NULL, attacker_id INT NOT NULL, defender_id INT NOT NULL, sentence_id INT NOT NULL, INDEX IDX_4ADEE46BFC7EEDB8 (combat_id), INDEX IDX_4ADEE46B65F8CAE3 (attacker_id), INDEX IDX_4ADEE46B4A3E3B6F (defender_id), INDEX IDX_4ADEE46B27289490 (sentence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characteristic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, short_code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fighting_style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, modifiers LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sentences (id INT AUTO_INCREMENT NOT NULL, style_id INT NOT NULL, race_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_ED2A8F1EBACD6074 (style_id), INDEX IDX_ED2A8F1E6E59D40D (race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warrior (id INT AUTO_INCREMENT NOT NULL, fighting_style_id INT NOT NULL, race_id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, victories INT NOT NULL, defeats INT NOT NULL, INDEX IDX_2E47A14B13949A02 (fighting_style_id), INDEX IDX_2E47A14B6E59D40D (race_id), INDEX IDX_2E47A14BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warrior_items (warrior_id INT NOT NULL, items_id INT NOT NULL, INDEX IDX_77EE4236452AFEA4 (warrior_id), INDEX IDX_77EE42366BB0AE84 (items_id), PRIMARY KEY(warrior_id, items_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warrior_characteristic (warrior_id INT NOT NULL, characteristic_id INT NOT NULL, INDEX IDX_78BFC005452AFEA4 (warrior_id), INDEX IDX_78BFC005DEE9D12B (characteristic_id), PRIMARY KEY(warrior_id, characteristic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE combat (id INT AUTO_INCREMENT NOT NULL, first_warrior_id INT NOT NULL, second_warrior_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_8D51E398D4B29FA3 (first_warrior_id), INDEX IDX_8D51E398A6741E37 (second_warrior_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE races (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, modifiers LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, modifiers LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46BFC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id)');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46B65F8CAE3 FOREIGN KEY (attacker_id) REFERENCES warrior (id)');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46B4A3E3B6F FOREIGN KEY (defender_id) REFERENCES warrior (id)');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46B27289490 FOREIGN KEY (sentence_id) REFERENCES sentences (id)');
        $this->addSql('ALTER TABLE sentences ADD CONSTRAINT FK_ED2A8F1EBACD6074 FOREIGN KEY (style_id) REFERENCES fighting_style (id)');
        $this->addSql('ALTER TABLE sentences ADD CONSTRAINT FK_ED2A8F1E6E59D40D FOREIGN KEY (race_id) REFERENCES races (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B13949A02 FOREIGN KEY (fighting_style_id) REFERENCES fighting_style (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B6E59D40D FOREIGN KEY (race_id) REFERENCES races (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE warrior_items ADD CONSTRAINT FK_77EE4236452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE warrior_items ADD CONSTRAINT FK_77EE42366BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE warrior_characteristic ADD CONSTRAINT FK_78BFC005452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE warrior_characteristic ADD CONSTRAINT FK_78BFC005DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398D4B29FA3 FOREIGN KEY (first_warrior_id) REFERENCES warrior (id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398A6741E37 FOREIGN KEY (second_warrior_id) REFERENCES warrior (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE warrior_characteristic DROP FOREIGN KEY FK_78BFC005DEE9D12B');
        $this->addSql('ALTER TABLE sentences DROP FOREIGN KEY FK_ED2A8F1EBACD6074');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B13949A02');
        $this->addSql('ALTER TABLE combat_line DROP FOREIGN KEY FK_4ADEE46B27289490');
        $this->addSql('ALTER TABLE combat_line DROP FOREIGN KEY FK_4ADEE46B65F8CAE3');
        $this->addSql('ALTER TABLE combat_line DROP FOREIGN KEY FK_4ADEE46B4A3E3B6F');
        $this->addSql('ALTER TABLE warrior_items DROP FOREIGN KEY FK_77EE4236452AFEA4');
        $this->addSql('ALTER TABLE warrior_characteristic DROP FOREIGN KEY FK_78BFC005452AFEA4');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E398D4B29FA3');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E398A6741E37');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14BA76ED395');
        $this->addSql('ALTER TABLE combat_line DROP FOREIGN KEY FK_4ADEE46BFC7EEDB8');
        $this->addSql('ALTER TABLE sentences DROP FOREIGN KEY FK_ED2A8F1E6E59D40D');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B6E59D40D');
        $this->addSql('ALTER TABLE warrior_items DROP FOREIGN KEY FK_77EE42366BB0AE84');
        $this->addSql('DROP TABLE combat_line');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('DROP TABLE fighting_style');
        $this->addSql('DROP TABLE sentences');
        $this->addSql('DROP TABLE warrior');
        $this->addSql('DROP TABLE warrior_items');
        $this->addSql('DROP TABLE warrior_characteristic');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE races');
        $this->addSql('DROP TABLE items');
    }
}
