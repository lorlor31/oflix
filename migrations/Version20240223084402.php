<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223084402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_casting_show');
        $this->addSql('DROP INDEX IDX_D11BBA508F93B6FC ON casting');
        $this->addSql('ALTER TABLE casting CHANGE movie_id show_id INT NOT NULL');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_casting_show FOREIGN KEY (show_id) REFERENCES `show` (id)');
        $this->addSql('CREATE INDEX IDX_D11BBA50D0C1FC64 ON casting (show_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_casting_show');
        $this->addSql('DROP INDEX IDX_D11BBA50D0C1FC64 ON casting');
        $this->addSql('ALTER TABLE casting CHANGE show_id movie_id INT NOT NULL');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_casting_show FOREIGN KEY (movie_id) REFERENCES `show` (id)');
        $this->addSql('CREATE INDEX IDX_D11BBA508F93B6FC ON casting (movie_id)');
    }
}
