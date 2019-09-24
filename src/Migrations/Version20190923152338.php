<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923152338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_EC2D9ACAA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__situation AS SELECT id, user_id, professionnelle, entreprise FROM situation');
        $this->addSql('DROP TABLE situation');
        $this->addSql('CREATE TABLE situation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, professionnelle VARCHAR(255) NOT NULL COLLATE BINARY, entreprise VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_EC2D9ACAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO situation (id, user_id, professionnelle, entreprise) SELECT id, user_id, professionnelle, entreprise FROM __temp__situation');
        $this->addSql('DROP TABLE __temp__situation');
        $this->addSql('CREATE INDEX IDX_EC2D9ACAA76ED395 ON situation (user_id)');
        $this->addSql('DROP INDEX IDX_40A0AC5B5200282E');
        $this->addSql('DROP INDEX IDX_40A0AC5BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_formation AS SELECT user_id, formation_id FROM user_formation');
        $this->addSql('DROP TABLE user_formation');
        $this->addSql('CREATE TABLE user_formation (user_id INTEGER NOT NULL, formation_id INTEGER NOT NULL, PRIMARY KEY(user_id, formation_id), CONSTRAINT FK_40A0AC5BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_40A0AC5B5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_formation (user_id, formation_id) SELECT user_id, formation_id FROM __temp__user_formation');
        $this->addSql('DROP TABLE __temp__user_formation');
        $this->addSql('CREATE INDEX IDX_40A0AC5B5200282E ON user_formation (formation_id)');
        $this->addSql('CREATE INDEX IDX_40A0AC5BA76ED395 ON user_formation (user_id)');
        $this->addSql('DROP INDEX IDX_ECCD172E3408E8AF');
        $this->addSql('DROP INDEX IDX_ECCD172EA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_situation AS SELECT user_id, situation_id FROM user_situation');
        $this->addSql('DROP TABLE user_situation');
        $this->addSql('CREATE TABLE user_situation (user_id INTEGER NOT NULL, situation_id INTEGER NOT NULL, PRIMARY KEY(user_id, situation_id), CONSTRAINT FK_ECCD172EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_ECCD172E3408E8AF FOREIGN KEY (situation_id) REFERENCES situation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_situation (user_id, situation_id) SELECT user_id, situation_id FROM __temp__user_situation');
        $this->addSql('DROP TABLE __temp__user_situation');
        $this->addSql('CREATE INDEX IDX_ECCD172E3408E8AF ON user_situation (situation_id)');
        $this->addSql('CREATE INDEX IDX_ECCD172EA76ED395 ON user_situation (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_EC2D9ACAA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__situation AS SELECT id, user_id, professionnelle, entreprise FROM situation');
        $this->addSql('DROP TABLE situation');
        $this->addSql('CREATE TABLE situation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, professionnelle VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO situation (id, user_id, professionnelle, entreprise) SELECT id, user_id, professionnelle, entreprise FROM __temp__situation');
        $this->addSql('DROP TABLE __temp__situation');
        $this->addSql('CREATE INDEX IDX_EC2D9ACAA76ED395 ON situation (user_id)');
        $this->addSql('DROP INDEX IDX_40A0AC5BA76ED395');
        $this->addSql('DROP INDEX IDX_40A0AC5B5200282E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_formation AS SELECT user_id, formation_id FROM user_formation');
        $this->addSql('DROP TABLE user_formation');
        $this->addSql('CREATE TABLE user_formation (user_id INTEGER NOT NULL, formation_id INTEGER NOT NULL, PRIMARY KEY(user_id, formation_id))');
        $this->addSql('INSERT INTO user_formation (user_id, formation_id) SELECT user_id, formation_id FROM __temp__user_formation');
        $this->addSql('DROP TABLE __temp__user_formation');
        $this->addSql('CREATE INDEX IDX_40A0AC5BA76ED395 ON user_formation (user_id)');
        $this->addSql('CREATE INDEX IDX_40A0AC5B5200282E ON user_formation (formation_id)');
        $this->addSql('DROP INDEX IDX_ECCD172EA76ED395');
        $this->addSql('DROP INDEX IDX_ECCD172E3408E8AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_situation AS SELECT user_id, situation_id FROM user_situation');
        $this->addSql('DROP TABLE user_situation');
        $this->addSql('CREATE TABLE user_situation (user_id INTEGER NOT NULL, situation_id INTEGER NOT NULL, PRIMARY KEY(user_id, situation_id))');
        $this->addSql('INSERT INTO user_situation (user_id, situation_id) SELECT user_id, situation_id FROM __temp__user_situation');
        $this->addSql('DROP TABLE __temp__user_situation');
        $this->addSql('CREATE INDEX IDX_ECCD172EA76ED395 ON user_situation (user_id)');
        $this->addSql('CREATE INDEX IDX_ECCD172E3408E8AF ON user_situation (situation_id)');
    }
}
