<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116200512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heat_activity DROP FOREIGN KEY FK_E1306027A7014910');
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B29395C3F3');
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B2F5B7AF75');
        $this->addSql('DROP TABLE facility');
        $this->addSql('DROP INDEX IDX_E1306027A7014910 ON heat_activity');
        $this->addSql('ALTER TABLE heat_activity ADD customer_id INT NOT NULL, ADD qr_code_url VARCHAR(255) DEFAULT NULL, ADD entry_link VARCHAR(255) NOT NULL, CHANGE facility_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE heat_activity ADD CONSTRAINT FK_E1306027F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE heat_activity ADD CONSTRAINT FK_E13060279395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1306027F5B7AF75 ON heat_activity (address_id)');
        $this->addSql('CREATE INDEX IDX_E13060279395C3F3 ON heat_activity (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facility (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, consult_link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, qr_code_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, entry_link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_105994B2F5B7AF75 (address_id), INDEX IDX_105994B29395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B29395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE heat_activity DROP FOREIGN KEY FK_E1306027F5B7AF75');
        $this->addSql('ALTER TABLE heat_activity DROP FOREIGN KEY FK_E13060279395C3F3');
        $this->addSql('DROP INDEX UNIQ_E1306027F5B7AF75 ON heat_activity');
        $this->addSql('DROP INDEX IDX_E13060279395C3F3 ON heat_activity');
        $this->addSql('ALTER TABLE heat_activity ADD facility_id INT NOT NULL, DROP address_id, DROP customer_id, DROP qr_code_url, DROP entry_link');
        $this->addSql('ALTER TABLE heat_activity ADD CONSTRAINT FK_E1306027A7014910 FOREIGN KEY (facility_id) REFERENCES facility (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E1306027A7014910 ON heat_activity (facility_id)');
    }
}
