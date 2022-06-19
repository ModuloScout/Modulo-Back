<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619122925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_invitation_user (event_invitation_id INT NOT NULL, user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_89417E2D8704CA5C (event_invitation_id), INDEX IDX_89417E2DA76ED395 (user_id), PRIMARY KEY(event_invitation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_invitation_user ADD CONSTRAINT FK_89417E2D8704CA5C FOREIGN KEY (event_invitation_id) REFERENCES event_invitation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_invitation_user ADD CONSTRAINT FK_89417E2DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_invitation_user');
    }
}
