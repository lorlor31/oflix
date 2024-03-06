<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306084514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_user (show_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5164008AD0C1FC64 (show_id), INDEX IDX_5164008AA76ED395 (user_id), PRIMARY KEY(show_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AD0C1FC64');
        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AA76ED395');
        $this->addSql('DROP TABLE show_user');
    }
}
