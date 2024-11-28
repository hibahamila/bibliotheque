<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127131903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7EBF07F38');
        $this->addSql('DROP INDEX IDX_364071D7EBF07F38 ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP livres_id');
        $this->addSql('ALTER TABLE livre CHANGE image image VARCHAR(30) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE emprunt ADD livres_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7EBF07F38 FOREIGN KEY (livres_id) REFERENCES livre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_364071D7EBF07F38 ON emprunt (livres_id)');
    }
}
