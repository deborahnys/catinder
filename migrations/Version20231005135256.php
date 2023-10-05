<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005135256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_like_cat (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, cat_id_id INT NOT NULL, is_liked TINYINT(1) NOT NULL, INDEX IDX_DD5505419D86650F (user_id_id), INDEX IDX_DD550541C33F2EBA (cat_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD5505419D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD550541C33F2EBA FOREIGN KEY (cat_id_id) REFERENCES cat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD5505419D86650F');
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD550541C33F2EBA');
        $this->addSql('DROP TABLE user_like_cat');
    }
}
