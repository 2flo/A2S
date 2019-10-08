<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191008143705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, tel INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE user_formation (user_id INTEGER NOT NULL, formation_id INTEGER NOT NULL, PRIMARY KEY(user_id, formation_id))');
        $this->addSql('CREATE INDEX IDX_40A0AC5BA76ED395 ON user_formation (user_id)');
        $this->addSql('CREATE INDEX IDX_40A0AC5B5200282E ON user_formation (formation_id)');
        $this->addSql('CREATE TABLE user_situation (user_id INTEGER NOT NULL, situation_id INTEGER NOT NULL, PRIMARY KEY(user_id, situation_id))');
        $this->addSql('CREATE INDEX IDX_ECCD172EA76ED395 ON user_situation (user_id)');
        $this->addSql('CREATE INDEX IDX_ECCD172E3408E8AF ON user_situation (situation_id)');
        $this->addSql('CREATE TABLE situation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, professionnelle VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_EC2D9ACAA76ED395 ON situation (user_id)');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user_name (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24A232CFE7927C74 ON user_name (email)');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, message CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE formation_categorie (formation_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, PRIMARY KEY(formation_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_830086E95200282E ON formation_categorie (formation_id)');
        $this->addSql('CREATE INDEX IDX_830086E9BCF5E72D ON formation_categorie (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_formation');
        $this->addSql('DROP TABLE user_situation');
        $this->addSql('DROP TABLE situation');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE user_name');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_categorie');
    }
}
