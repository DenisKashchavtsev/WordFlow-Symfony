<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808200332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_user (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_421A9847E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_category (id VARCHAR(26) NOT NULL, user_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, is_public BOOLEAN NOT NULL DEFAULT false, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_learning_history (id VARCHAR(26) NOT NULL, word_id VARCHAR(26) DEFAULT NULL, user_id VARCHAR(255) NOT NULL, step VARCHAR(255) NOT NULL, learned_at DATE NOT NULL, INDEX IDX_2EDF2C13E357438D (word_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_learning_session (id VARCHAR(26) NOT NULL, category_id VARCHAR(26) DEFAULT NULL, user_id VARCHAR(255) NOT NULL, started_at DATE NOT NULL, ended_at DATE NOT NULL, INDEX IDX_D921898C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_word (id VARCHAR(26) NOT NULL, category_id VARCHAR(26) DEFAULT NULL, source VARCHAR(255) NOT NULL, translate VARCHAR(255) NOT NULL, INDEX IDX_3009CB8112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE words_learning_history ADD CONSTRAINT FK_2EDF2C13E357438D FOREIGN KEY (word_id) REFERENCES words_word (id)');
        $this->addSql('ALTER TABLE words_learning_session ADD CONSTRAINT FK_D921898C12469DE2 FOREIGN KEY (category_id) REFERENCES words_category (id)');
        $this->addSql('ALTER TABLE words_word ADD CONSTRAINT FK_3009CB8112469DE2 FOREIGN KEY (category_id) REFERENCES words_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE words_learning_history DROP FOREIGN KEY FK_2EDF2C13E357438D');
        $this->addSql('ALTER TABLE words_learning_session DROP FOREIGN KEY FK_D921898C12469DE2');
        $this->addSql('ALTER TABLE words_word DROP FOREIGN KEY FK_3009CB8112469DE2');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE users_user');
        $this->addSql('DROP TABLE words_category');
        $this->addSql('DROP TABLE words_learning_history');
        $this->addSql('DROP TABLE words_learning_session');
        $this->addSql('DROP TABLE words_word');
    }
}
