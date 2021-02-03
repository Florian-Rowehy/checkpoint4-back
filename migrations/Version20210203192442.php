<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203192442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_classification (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E3505EB9CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_classification ADD CONSTRAINT FK_E3505EB9CCF9E01E FOREIGN KEY (departement_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE article ADD article_classification_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E39D2162 FOREIGN KEY (article_classification_id) REFERENCES article_classification (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66E39D2162 ON article (article_classification_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E39D2162');
        $this->addSql('DROP TABLE article_classification');
        $this->addSql('DROP INDEX IDX_23A0E66E39D2162 ON article');
        $this->addSql('ALTER TABLE article DROP article_classification_id');
    }
}
