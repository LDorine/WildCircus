<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717111633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE billet_representation (billet_id INT NOT NULL, representation_id INT NOT NULL, INDEX IDX_CF45D9DD44973C78 (billet_id), INDEX IDX_CF45D9DD46CE82F4 (representation_id), PRIMARY KEY(billet_id, representation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE representation (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, place_id INT NOT NULL, emplacement VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix INT NOT NULL, INDEX IDX_741D53CDDA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet_representation ADD CONSTRAINT FK_CF45D9DD44973C78 FOREIGN KEY (billet_id) REFERENCES billet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE billet_representation ADD CONSTRAINT FK_CF45D9DD46CE82F4 FOREIGN KEY (representation_id) REFERENCES representation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDDA6A219 FOREIGN KEY (place_id) REFERENCES billet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet_representation DROP FOREIGN KEY FK_CF45D9DD44973C78');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDDA6A219');
        $this->addSql('ALTER TABLE billet_representation DROP FOREIGN KEY FK_CF45D9DD46CE82F4');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE billet_representation');
        $this->addSql('DROP TABLE representation');
        $this->addSql('DROP TABLE place');
    }
}
