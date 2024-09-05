<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905145310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE who_we_are_page ADD image2 VARCHAR(255) DEFAULT NULL, ADD image_updated_at2 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image3 VARCHAR(255) DEFAULT NULL, ADD image_updated_at3 DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE who_we_are_page DROP image2, DROP image_updated_at2, DROP image3, DROP image_updated_at3');
    }
}
