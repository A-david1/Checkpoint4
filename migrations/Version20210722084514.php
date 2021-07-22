<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722084514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, editon VARCHAR(255) DEFAULT NULL, isbn VARCHAR(255) DEFAULT NULL, release_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reading_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, started_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', added_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', finished_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_739E904CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reading_status (id INT AUTO_INCREMENT NOT NULL, reading_list_id INT NOT NULL, book_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E6BE2370793785BE (reading_list_id), INDEX IDX_E6BE237016A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D6495126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reading_list ADD CONSTRAINT FK_739E904CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reading_status ADD CONSTRAINT FK_E6BE2370793785BE FOREIGN KEY (reading_list_id) REFERENCES reading_list (id)');
        $this->addSql('ALTER TABLE reading_status ADD CONSTRAINT FK_E6BE237016A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reading_status DROP FOREIGN KEY FK_E6BE237016A2B381');
        $this->addSql('ALTER TABLE reading_status DROP FOREIGN KEY FK_E6BE2370793785BE');
        $this->addSql('ALTER TABLE reading_list DROP FOREIGN KEY FK_739E904CA76ED395');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE reading_list');
        $this->addSql('DROP TABLE reading_status');
        $this->addSql('DROP TABLE user');
    }
}
