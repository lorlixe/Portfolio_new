<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250223020442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_categorie (post_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_E813A8C34B89032C (post_id), INDEX IDX_E813A8C3BCF5E72D (categorie_id), PRIMARY KEY(post_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_categorie ADD CONSTRAINT FK_E813A8C34B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_categorie ADD CONSTRAINT FK_E813A8C3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_post DROP FOREIGN KEY FK_2DA3EBDA4B89032C');
        $this->addSql('ALTER TABLE categorie_post DROP FOREIGN KEY FK_2DA3EBDABCF5E72D');
        $this->addSql('ALTER TABLE categorie_project DROP FOREIGN KEY FK_70307E4CBCF5E72D');
        $this->addSql('ALTER TABLE categorie_project DROP FOREIGN KEY FK_70307E4C166D1F9C');
        $this->addSql('ALTER TABLE stack_project DROP FOREIGN KEY FK_6463EB4B166D1F9C');
        $this->addSql('ALTER TABLE stack_project DROP FOREIGN KEY FK_6463EB4B37C70060');
        $this->addSql('DROP TABLE categorie_post');
        $this->addSql('DROP TABLE categorie_project');
        $this->addSql('DROP TABLE stack_project');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_post (categorie_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_2DA3EBDA4B89032C (post_id), INDEX IDX_2DA3EBDABCF5E72D (categorie_id), PRIMARY KEY(categorie_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_project (categorie_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_70307E4CBCF5E72D (categorie_id), INDEX IDX_70307E4C166D1F9C (project_id), PRIMARY KEY(categorie_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stack_project (stack_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_6463EB4B166D1F9C (project_id), INDEX IDX_6463EB4B37C70060 (stack_id), PRIMARY KEY(stack_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_post ADD CONSTRAINT FK_2DA3EBDA4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_post ADD CONSTRAINT FK_2DA3EBDABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_project ADD CONSTRAINT FK_70307E4CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_project ADD CONSTRAINT FK_70307E4C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stack_project ADD CONSTRAINT FK_6463EB4B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stack_project ADD CONSTRAINT FK_6463EB4B37C70060 FOREIGN KEY (stack_id) REFERENCES stack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_categorie DROP FOREIGN KEY FK_E813A8C34B89032C');
        $this->addSql('ALTER TABLE post_categorie DROP FOREIGN KEY FK_E813A8C3BCF5E72D');
        $this->addSql('DROP TABLE post_categorie');
    }
}
