<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509155010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EE4084792');
        $this->addSql('DROP INDEX IDX_B6F7494EE4084792 ON question');
        $this->addSql('ALTER TABLE question DROP reponses_id');
        $this->addSql('ALTER TABLE reponse ADD questions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7BCB134CE FOREIGN KEY (questions_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7BCB134CE ON reponse (questions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD reponses_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EE4084792 FOREIGN KEY (reponses_id) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EE4084792 ON question (reponses_id)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7BCB134CE');
        $this->addSql('DROP INDEX IDX_5FB6DEC7BCB134CE ON reponse');
        $this->addSql('ALTER TABLE reponse DROP questions_id');
    }
}
