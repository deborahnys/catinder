<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007001006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat ADD race_id INT NOT NULL, DROP race');
        $this->addSql('ALTER TABLE cat ADD CONSTRAINT FK_9E5E43A86E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('CREATE INDEX IDX_9E5E43A86E59D40D ON cat (race_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat DROP FOREIGN KEY FK_9E5E43A86E59D40D');
        $this->addSql('DROP INDEX IDX_9E5E43A86E59D40D ON cat');
        $this->addSql('ALTER TABLE cat ADD race VARCHAR(255) NOT NULL, DROP race_id');
    }
}
