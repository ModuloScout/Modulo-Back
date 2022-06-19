<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610072340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credential ADD feature_id INT DEFAULT NULL, ADD role_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE credential ADD CONSTRAINT FK_57F1D4B60E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id)');
        $this->addSql('ALTER TABLE credential ADD CONSTRAINT FK_57F1D4BD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_57F1D4B60E4B879 ON credential (feature_id)');
        $this->addSql('CREATE INDEX IDX_57F1D4BD60322AC ON credential (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credential DROP FOREIGN KEY FK_57F1D4B60E4B879');
        $this->addSql('ALTER TABLE credential DROP FOREIGN KEY FK_57F1D4BD60322AC');
        $this->addSql('DROP INDEX IDX_57F1D4B60E4B879 ON credential');
        $this->addSql('DROP INDEX IDX_57F1D4BD60322AC ON credential');
        $this->addSql('ALTER TABLE credential DROP feature_id, DROP role_id');
    }
}
