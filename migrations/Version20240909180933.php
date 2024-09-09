<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909180933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_manual ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_manual ADD CONSTRAINT FK_72A7FF604584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_72A7FF604584665A ON product_manual (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_manual DROP FOREIGN KEY FK_72A7FF604584665A');
        $this->addSql('DROP INDEX IDX_72A7FF604584665A ON product_manual');
        $this->addSql('ALTER TABLE product_manual DROP product_id');
    }
}
