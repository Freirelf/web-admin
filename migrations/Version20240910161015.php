<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910161015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, status INT DEFAULT NULL, highlighted INT DEFAULT NULL, date DATE DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, youtube_video_code VARCHAR(255) DEFAULT NULL, full_description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, image_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', language INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_news_category (news_id INT NOT NULL, news_category_id INT NOT NULL, INDEX IDX_1A91D6D6B5A459A0 (news_id), INDEX IDX_1A91D6D63B732BAD (news_category_id), PRIMARY KEY(news_id, news_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_news_category ADD CONSTRAINT FK_1A91D6D6B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_news_category ADD CONSTRAINT FK_1A91D6D63B732BAD FOREIGN KEY (news_category_id) REFERENCES news_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news_news_category DROP FOREIGN KEY FK_1A91D6D6B5A459A0');
        $this->addSql('ALTER TABLE news_news_category DROP FOREIGN KEY FK_1A91D6D63B732BAD');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_news_category');
    }
}
