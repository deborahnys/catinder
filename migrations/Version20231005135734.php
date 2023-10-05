<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005135734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD5505419D86650F');
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD550541C33F2EBA');
        $this->addSql('DROP INDEX IDX_DD5505419D86650F ON user_like_cat');
        $this->addSql('DROP INDEX IDX_DD550541C33F2EBA ON user_like_cat');
        $this->addSql('ALTER TABLE user_like_cat ADD user_id INT NOT NULL, ADD cat_id INT NOT NULL, DROP user_id_id, DROP cat_id_id');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD550541A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD550541E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id)');
        $this->addSql('CREATE INDEX IDX_DD550541A76ED395 ON user_like_cat (user_id)');
        $this->addSql('CREATE INDEX IDX_DD550541E6ADA943 ON user_like_cat (cat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD550541A76ED395');
        $this->addSql('ALTER TABLE user_like_cat DROP FOREIGN KEY FK_DD550541E6ADA943');
        $this->addSql('DROP INDEX IDX_DD550541A76ED395 ON user_like_cat');
        $this->addSql('DROP INDEX IDX_DD550541E6ADA943 ON user_like_cat');
        $this->addSql('ALTER TABLE user_like_cat ADD user_id_id INT NOT NULL, ADD cat_id_id INT NOT NULL, DROP user_id, DROP cat_id');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD5505419D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_like_cat ADD CONSTRAINT FK_DD550541C33F2EBA FOREIGN KEY (cat_id_id) REFERENCES cat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DD5505419D86650F ON user_like_cat (user_id_id)');
        $this->addSql('CREATE INDEX IDX_DD550541C33F2EBA ON user_like_cat (cat_id_id)');
    }
}
