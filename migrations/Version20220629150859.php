<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629150859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D580FCA4BF');
        $this->addSql('DROP INDEX IDX_8ADC54D580FCA4BF ON questions');
        $this->addSql('ALTER TABLE questions DROP formulaires_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions ADD formulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D580FCA4BF FOREIGN KEY (formulaires_id) REFERENCES formulaires (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D580FCA4BF ON questions (formulaires_id)');
    }
}
