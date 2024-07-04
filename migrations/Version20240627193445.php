<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627193445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empleado (id BIGINT AUTO_INCREMENT NOT NULL, nombres VARCHAR(100) DEFAULT NULL, apellidos VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proyecto (id BIGINT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarea (id BIGINT AUTO_INCREMENT NOT NULL, empleado BIGINT DEFAULT NULL, proyecto BIGINT DEFAULT NULL, descripcion VARCHAR(200) DEFAULT NULL, fecha_inicio DATE DEFAULT NULL, fecha_fin DATE DEFAULT NULL, tiempo_estimado INT DEFAULT NULL, estado VARCHAR(50) DEFAULT NULL, INDEX IDX_3CA05366D9D9BF52 (empleado), INDEX IDX_3CA053666FD202B9 (proyecto), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366D9D9BF52 FOREIGN KEY (empleado) REFERENCES empleado (id)');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA053666FD202B9 FOREIGN KEY (proyecto) REFERENCES proyecto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA05366D9D9BF52');
        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA053666FD202B9');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE proyecto');
        $this->addSql('DROP TABLE tarea');
    }
}
