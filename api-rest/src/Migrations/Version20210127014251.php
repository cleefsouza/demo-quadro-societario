<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127014251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE empresa (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, razao_social VARCHAR(255) NOT NULL, nome_fantasia VARCHAR(255) NOT NULL, atividade_principal VARCHAR(255) NOT NULL, cnpj VARCHAR(255) NOT NULL, situacao_cadastral BOOLEAN NOT NULL, data_abertura DATE NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8D75A50C8C6906B ON empresa (cnpj)');
        $this->addSql('CREATE TABLE socio (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome_completo VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nascimento DATE NOT NULL, sexo VARCHAR(255) NOT NULL, empresa_id INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B653093E3E11F0 ON socio (cpf)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE socio');
    }
}
