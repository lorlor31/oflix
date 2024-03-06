<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306101849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_show (user_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_488F95C8A76ED395 (user_id), INDEX IDX_488F95C8D0C1FC64 (show_id), PRIMARY KEY(user_id, show_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_show ADD CONSTRAINT FK_488F95C8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_show ADD CONSTRAINT FK_488F95C8D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AA76ED395');
        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AD0C1FC64');
        $this->addSql('DROP TABLE show_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_user (show_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5164008AD0C1FC64 (show_id), INDEX IDX_5164008AA76ED395 (user_id), PRIMARY KEY(show_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_show DROP FOREIGN KEY FK_488F95C8A76ED395');
        $this->addSql('ALTER TABLE user_show DROP FOREIGN KEY FK_488F95C8D0C1FC64');
        $this->addSql('DROP TABLE user_show');
    }
}
