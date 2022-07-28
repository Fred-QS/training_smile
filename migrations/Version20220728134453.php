<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728134453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE book_id book_id INT NOT NULL, CHANGE published_at posted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE movie ADD imdb_id VARCHAR(255) DEFAULT NULL, ADD rated NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE movie_genre DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_A058EDAA4296D31F');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_A058EDAA8F93B6FC');
        $this->addSql('ALTER TABLE movie_genre ADD PRIMARY KEY (movie_id, genre_id)');
        $this->addSql('DROP INDEX idx_a058edaa8f93b6fc ON movie_genre');
        $this->addSql('CREATE INDEX IDX_FD1229648F93B6FC ON movie_genre (movie_id)');
        $this->addSql('DROP INDEX idx_a058edaa4296d31f ON movie_genre');
        $this->addSql('CREATE INDEX IDX_FD1229644296D31F ON movie_genre (genre_id)');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_A058EDAA4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_A058EDAA8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE book_id book_id INT DEFAULT NULL, CHANGE posted_at published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE movie DROP imdb_id, DROP rated');
        $this->addSql('ALTER TABLE movie_genre DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229648F93B6FC');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229644296D31F');
        $this->addSql('ALTER TABLE movie_genre ADD PRIMARY KEY (genre_id, movie_id)');
        $this->addSql('DROP INDEX idx_fd1229644296d31f ON movie_genre');
        $this->addSql('CREATE INDEX IDX_A058EDAA4296D31F ON movie_genre (genre_id)');
        $this->addSql('DROP INDEX idx_fd1229648f93b6fc ON movie_genre');
        $this->addSql('CREATE INDEX IDX_A058EDAA8F93B6FC ON movie_genre (movie_id)');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229648F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229644296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }
}
