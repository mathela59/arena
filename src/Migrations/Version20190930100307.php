<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930100307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fighting_style CHANGE modifiers modifiers VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sentences CHANGE style_id style_id INT DEFAULT NULL, CHANGE race_id race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE warrior_characteristic ADD intelligence_id INT NOT NULL');
        $this->addSql('ALTER TABLE warrior_characteristic ADD CONSTRAINT FK_78BFC0057584E372 FOREIGN KEY (intelligence_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_78BFC0057584E372 ON warrior_characteristic (intelligence_id)');
        $this->addSql('ALTER TABLE warrior ADD strength_id INT NOT NULL, ADD constitution_id INT NOT NULL, ADD intelligence_id INT NOT NULL, ADD speed_id INT NOT NULL, ADD dexterity_id INT NOT NULL, ADD armor_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B100368EB FOREIGN KEY (strength_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BBDA9478A FOREIGN KEY (constitution_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B7584E372 FOREIGN KEY (intelligence_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B8F3A8393 FOREIGN KEY (speed_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B76B178A3 FOREIGN KEY (dexterity_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BF5AA3663 FOREIGN KEY (armor_id) REFERENCES warrior_characteristic (id)');
        $this->addSql('CREATE INDEX IDX_2E47A14B100368EB ON warrior (strength_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14BBDA9478A ON warrior (constitution_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E47A14B7584E372 ON warrior (intelligence_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E47A14B8F3A8393 ON warrior (speed_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E47A14B76B178A3 ON warrior (dexterity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E47A14BF5AA3663 ON warrior (armor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fighting_style CHANGE modifiers modifiers VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sentences CHANGE style_id style_id INT DEFAULT NULL, CHANGE race_id race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B100368EB');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14BBDA9478A');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B7584E372');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B8F3A8393');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14B76B178A3');
        $this->addSql('ALTER TABLE warrior DROP FOREIGN KEY FK_2E47A14BF5AA3663');
        $this->addSql('DROP INDEX IDX_2E47A14B100368EB ON warrior');
        $this->addSql('DROP INDEX IDX_2E47A14BBDA9478A ON warrior');
        $this->addSql('DROP INDEX UNIQ_2E47A14B7584E372 ON warrior');
        $this->addSql('DROP INDEX UNIQ_2E47A14B8F3A8393 ON warrior');
        $this->addSql('DROP INDEX UNIQ_2E47A14B76B178A3 ON warrior');
        $this->addSql('DROP INDEX UNIQ_2E47A14BF5AA3663 ON warrior');
        $this->addSql('ALTER TABLE warrior DROP strength_id, DROP constitution_id, DROP intelligence_id, DROP speed_id, DROP dexterity_id, DROP armor_id, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE warrior_characteristic DROP FOREIGN KEY FK_78BFC0057584E372');
        $this->addSql('DROP INDEX UNIQ_78BFC0057584E372 ON warrior_characteristic');
        $this->addSql('ALTER TABLE warrior_characteristic DROP intelligence_id');
    }
}
