<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260208173708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE indicateur_impact (id INT AUTO_INCREMENT NOT NULL, total_kg_recoltes DOUBLE PRECISION NOT NULL, co2_evite DOUBLE PRECISION NOT NULL, date_calcul DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE zone_polluee (id INT AUTO_INCREMENT NOT NULL, nom_zone VARCHAR(255) NOT NULL, coordonnees_gps VARCHAR(255) NOT NULL, niveau_pollution INT NOT NULL, indicateur_id INT DEFAULT NULL, INDEX IDX_6CC8C39BDA3B8F3D (indicateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE zone_polluee ADD CONSTRAINT FK_6CC8C39BDA3B8F3D FOREIGN KEY (indicateur_id) REFERENCES indicateur_impact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zone_polluee DROP FOREIGN KEY FK_6CC8C39BDA3B8F3D');
        $this->addSql('DROP TABLE indicateur_impact');
        $this->addSql('DROP TABLE zone_polluee');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
