<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610091034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_event_authorization (id INT AUTO_INCREMENT NOT NULL, role_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', type_event_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_D88088ECD60322AC (role_id), INDEX IDX_D88088ECBC08CF77 (type_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_event_authorization ADD CONSTRAINT FK_D88088ECD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE type_event_authorization ADD CONSTRAINT FK_D88088ECBC08CF77 FOREIGN KEY (type_event_id) REFERENCES type_event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE type_event_authorization');
    }
}
