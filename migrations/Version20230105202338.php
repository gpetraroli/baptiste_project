<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105202338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE heat_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, facility_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, CONSTRAINT FK_E1306027A7014910 FOREIGN KEY (facility_id) REFERENCES facility (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E1306027A7014910 ON heat_activity (facility_id)');
        $this->addSql('DROP TABLE activity_heat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity_heat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE heat_activity');
    }
}