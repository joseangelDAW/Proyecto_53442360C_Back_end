<?php declare(strict_types = 1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180822090906 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D4E6F81A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, user_id, number, street, floor, floor_information, cp, province, city FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER NOT NULL, user_id INTEGER NOT NULL, number VARCHAR(4) NOT NULL COLLATE BINARY, street VARCHAR(40) NOT NULL COLLATE BINARY, floor VARCHAR(20) NOT NULL COLLATE BINARY, floor_information VARCHAR(20) NOT NULL COLLATE BINARY, cp INTEGER NOT NULL, province VARCHAR(20) NOT NULL COLLATE BINARY, city VARCHAR(20) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO address (id, user_id, number, street, floor, floor_information, cp, province, city) SELECT id, user_id, number, street, floor, floor_information, cp, province, city FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('DROP INDEX IDX_E4529B85A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pet AS SELECT id, user_id, name, type_pet, sex, race, birth_date, image FROM pet');
        $this->addSql('DROP TABLE pet');
        $this->addSql('CREATE TABLE pet (id INTEGER NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(25) NOT NULL COLLATE BINARY, type_pet VARCHAR(25) NOT NULL COLLATE BINARY, sex VARCHAR(25) NOT NULL COLLATE BINARY, race VARCHAR(40) NOT NULL COLLATE BINARY, birth_date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_E4529B85A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO pet (id, user_id, name, type_pet, sex, race, birth_date, image) SELECT id, user_id, name, type_pet, sex, race, birth_date, image FROM __temp__pet');
        $this->addSql('DROP TABLE __temp__pet');
        $this->addSql('CREATE INDEX IDX_E4529B85A76ED395 ON pet (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D4E6F81A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, user_id, number, street, floor, floor_information, cp, province, city FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER NOT NULL, user_id INTEGER NOT NULL, number VARCHAR(4) NOT NULL, street VARCHAR(40) NOT NULL, floor VARCHAR(20) NOT NULL, floor_information VARCHAR(20) NOT NULL, cp INTEGER NOT NULL, province VARCHAR(20) NOT NULL, city VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO address (id, user_id, number, street, floor, floor_information, cp, province, city) SELECT id, user_id, number, street, floor, floor_information, cp, province, city FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('DROP INDEX IDX_E4529B85A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pet AS SELECT id, user_id, name, type_pet, sex, race, birth_date, image FROM pet');
        $this->addSql('DROP TABLE pet');
        $this->addSql('CREATE TABLE pet (id INTEGER NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(25) NOT NULL, type_pet VARCHAR(25) NOT NULL, sex VARCHAR(25) NOT NULL, race VARCHAR(40) NOT NULL, birth_date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO pet (id, user_id, name, type_pet, sex, race, birth_date, image) SELECT id, user_id, name, type_pet, sex, race, birth_date, image FROM __temp__pet');
        $this->addSql('DROP TABLE __temp__pet');
        $this->addSql('CREATE INDEX IDX_E4529B85A76ED395 ON pet (user_id)');
    }
}
