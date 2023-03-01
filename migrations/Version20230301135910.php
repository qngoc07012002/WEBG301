<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301135910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE song (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, artist_id INT NOT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, song_url VARCHAR(255) NOT NULL, INDEX IDX_33EDEEA112469DE2 (category_id), INDEX IDX_33EDEEA1B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA1B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA112469DE2');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA1B7970CF8');
        $this->addSql('DROP TABLE song');
    }
}
