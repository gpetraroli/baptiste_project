<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104214502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facility ADD COLUMN consult_link VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__facility AS SELECT id, address_id, customer_id, name, public_message_fr, public_message_en, type FROM facility');
        $this->addSql('DROP TABLE facility');
        $this->addSql('CREATE TABLE facility (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, customer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, public_message_fr CLOB NOT NULL, public_message_en CLOB NOT NULL, type VARCHAR(80) NOT NULL, CONSTRAINT FK_105994B2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_105994B29395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO facility (id, address_id, customer_id, name, public_message_fr, public_message_en, type) SELECT id, address_id, customer_id, name, public_message_fr, public_message_en, type FROM __temp__facility');
        $this->addSql('DROP TABLE __temp__facility');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_105994B2F5B7AF75 ON facility (address_id)');
        $this->addSql('CREATE INDEX IDX_105994B29395C3F3 ON facility (customer_id)');
    }
}
