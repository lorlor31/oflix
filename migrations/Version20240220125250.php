<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220125250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, show_id INT NOT NULL, number SMALLINT NOT NULL, episode_count SMALLINT NOT NULL, INDEX IDX_F0E45BA9D0C1FC64 (show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D0C1FC64');
        $this->addSql('DROP TABLE season');
    }
}
