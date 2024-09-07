<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240906205133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_property_value (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, product_property_id INT DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, language INT DEFAULT NULL, INDEX IDX_880DE7154584665A (product_id), INDEX IDX_880DE715F8BD8DF3 (product_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_property_value ADD CONSTRAINT FK_880DE7154584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_property_value ADD CONSTRAINT FK_880DE715F8BD8DF3 FOREIGN KEY (product_property_id) REFERENCES product_property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_property_value DROP FOREIGN KEY FK_880DE7154584665A');
        $this->addSql('ALTER TABLE product_property_value DROP FOREIGN KEY FK_880DE715F8BD8DF3');
        $this->addSql('DROP TABLE product_property_value');
    }
}
