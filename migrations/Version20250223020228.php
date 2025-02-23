<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250223020228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_stack (project_id INT NOT NULL, stack_id INT NOT NULL, INDEX IDX_52FD72F4166D1F9C (project_id), INDEX IDX_52FD72F437C70060 (stack_id), PRIMARY KEY(project_id, stack_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_categorie (project_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_584193E3166D1F9C (project_id), INDEX IDX_584193E3BCF5E72D (categorie_id), PRIMARY KEY(project_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_stack ADD CONSTRAINT FK_52FD72F4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_stack ADD CONSTRAINT FK_52FD72F437C70060 FOREIGN KEY (stack_id) REFERENCES stack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_categorie ADD CONSTRAINT FK_584193E3166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_categorie ADD CONSTRAINT FK_584193E3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_stack DROP FOREIGN KEY FK_52FD72F4166D1F9C');
        $this->addSql('ALTER TABLE project_stack DROP FOREIGN KEY FK_52FD72F437C70060');
        $this->addSql('ALTER TABLE project_categorie DROP FOREIGN KEY FK_584193E3166D1F9C');
        $this->addSql('ALTER TABLE project_categorie DROP FOREIGN KEY FK_584193E3BCF5E72D');
        $this->addSql('DROP TABLE project_stack');
        $this->addSql('DROP TABLE project_categorie');
    }
}
