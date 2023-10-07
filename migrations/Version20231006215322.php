<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006215322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat ADD color_id INT NOT NULL, DROP color');
        $this->addSql('ALTER TABLE cat ADD CONSTRAINT FK_9E5E43A87ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_9E5E43A87ADA1FB5 ON cat (color_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat DROP FOREIGN KEY FK_9E5E43A87ADA1FB5');
        $this->addSql('DROP INDEX IDX_9E5E43A87ADA1FB5 ON cat');
        $this->addSql('ALTER TABLE cat ADD color VARCHAR(255) NOT NULL, DROP color_id');
    }
}
