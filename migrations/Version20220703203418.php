<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703203418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD adresse_des_parents VARCHAR(255) DEFAULT NULL, ADD premier_annee VARCHAR(255) DEFAULT NULL, ADD deuxieme_annee VARCHAR(255) DEFAULT NULL, ADD diplome_obtenu VARCHAR(255) DEFAULT NULL, DROP adresse_parents, DROP premiereannee, DROP deuxiemeannee, DROP diplomeobtenu, CHANGE date_of_birth date_de_naissance DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD adresse_parents VARCHAR(255) DEFAULT NULL, ADD premiereannee VARCHAR(255) DEFAULT NULL, ADD deuxiemeannee VARCHAR(255) DEFAULT NULL, ADD diplomeobtenu VARCHAR(255) DEFAULT NULL, DROP adresse_des_parents, DROP premier_annee, DROP deuxieme_annee, DROP diplome_obtenu, CHANGE date_de_naissance date_of_birth DATETIME NOT NULL');
    }
}
