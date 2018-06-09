<?php declare(strict_types = 1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180609154420 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE entry_entity (id INTEGER NOT NULL, title VARCHAR(100) NOT NULL, image VARCHAR(100) DEFAULT NULL, content CLOB NOT NULL, date_entry DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE address (id INTEGER NOT NULL, user_id INTEGER NOT NULL, number VARCHAR(4) NOT NULL, street VARCHAR(40) NOT NULL, floor VARCHAR(20) NOT NULL, floor_information VARCHAR(20) NOT NULL, cp INTEGER NOT NULL, province VARCHAR(20) NOT NULL, city VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, name VARCHAR(25) NOT NULL, surname VARCHAR(40) NOT NULL, nickname VARCHAR(20) NOT NULL, password VARCHAR(60) NOT NULL, birth_date DATE NOT NULL, email VARCHAR(60) NOT NULL, role VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A188FE64 ON user (nickname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE pet (id INTEGER NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(25) NOT NULL, type_pet VARCHAR(25) NOT NULL, sex VARCHAR(25) NOT NULL, race VARCHAR(40) NOT NULL, birth_date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E4529B85A76ED395 ON pet (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE entry_entity');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE pet');
    }
}
