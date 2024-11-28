<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127141510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D71E969C5');
        $this->addSql('DROP INDEX IDX_364071D71E969C5 ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP utilisateurs_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C9139BF1');
        $this->addSql('DROP INDEX IDX_1D1C63B3C9139BF1 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP historique_emprunts_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD historique_emprunts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C9139BF1 FOREIGN KEY (historique_emprunts_id) REFERENCES emprunt (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1D1C63B3C9139BF1 ON utilisateur (historique_emprunts_id)');
        $this->addSql('ALTER TABLE emprunt ADD utilisateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D71E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_364071D71E969C5 ON emprunt (utilisateurs_id)');
    }
}
