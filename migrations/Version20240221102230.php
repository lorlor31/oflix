<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221102230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_genre (show_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_81E15724D0C1FC64 (show_id), INDEX IDX_81E157244296D31F (genre_id), PRIMARY KEY(show_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE show_genre ADD CONSTRAINT FK_81E15724D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_genre ADD CONSTRAINT FK_81E157244296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_genre DROP FOREIGN KEY FK_81E15724D0C1FC64');
        $this->addSql('ALTER TABLE show_genre DROP FOREIGN KEY FK_81E157244296D31F');
        $this->addSql('DROP TABLE show_genre');
    }
}
