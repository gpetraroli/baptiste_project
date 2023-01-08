<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107172528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE heat_activity_entry (id INT AUTO_INCREMENT NOT NULL, heat_activity_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', type VARCHAR(80) DEFAULT NULL, name_oa VARCHAR(255) DEFAULT NULL, comments LONGTEXT NOT NULL, work_identifier VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_7A8971191867CEBF (heat_activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heat_activity_entry ADD CONSTRAINT FK_7A8971191867CEBF FOREIGN KEY (heat_activity_id) REFERENCES heat_activity (id)');
        $this->addSql('ALTER TABLE facility DROP public_message_fr, DROP public_message_en');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heat_activity_entry DROP FOREIGN KEY FK_7A8971191867CEBF');
        $this->addSql('DROP TABLE heat_activity_entry');
        $this->addSql('ALTER TABLE facility ADD public_message_fr LONGTEXT NOT NULL, ADD public_message_en LONGTEXT NOT NULL');
    }
}
