<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106160336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number VARCHAR(10) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, position VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, billing_address_id INTEGER DEFAULT NULL, reference_contact_id INTEGER DEFAULT NULL, company_name VARCHAR(255) NOT NULL, CONSTRAINT FK_81398E0979D0C0E4 FOREIGN KEY (billing_address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_81398E09B3BF1005 FOREIGN KEY (reference_contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E0979D0C0E4 ON customer (billing_address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09B3BF1005 ON customer (reference_contact_id)');
        $this->addSql('CREATE TABLE facility (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, customer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, public_message_fr CLOB NOT NULL, public_message_en CLOB NOT NULL, type VARCHAR(80) NOT NULL, consult_link VARCHAR(255) NOT NULL, CONSTRAINT FK_105994B2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_105994B29395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_105994B2F5B7AF75 ON facility (address_id)');
        $this->addSql('CREATE INDEX IDX_105994B29395C3F3 ON facility (customer_id)');
        $this->addSql('CREATE TABLE heat_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, facility_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, CONSTRAINT FK_E1306027A7014910 FOREIGN KEY (facility_id) REFERENCES facility (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E1306027A7014910 ON heat_activity (facility_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, uuid VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D6499395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D17F50A6 ON user (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499395C3F3 ON user (customer_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE facility');
        $this->addSql('DROP TABLE heat_activity');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
