<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200208180426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE empresa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE socio_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE empresa (id INT NOT NULL, razao_social VARCHAR(255) NOT NULL, nome_fantasia VARCHAR(255) NOT NULL, atividade_principal VARCHAR(255) NOT NULL, cnpj VARCHAR(255) NOT NULL, situacao_cadastral BOOLEAN NOT NULL, data_abertura DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8D75A50C8C6906B ON empresa (cnpj)');
        $this->addSql('CREATE TABLE socio (id INT NOT NULL, empresa_id INT NOT NULL, nome_completo VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nascimento DATE NOT NULL, sexo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B653093E3E11F0 ON socio (cpf)');
        $this->addSql('CREATE INDEX IDX_38B65309521E1991 ON socio (empresa_id)');
        $this->addSql('ALTER TABLE socio ADD CONSTRAINT FK_38B65309521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE socio DROP CONSTRAINT FK_38B65309521E1991');
        $this->addSql('DROP SEQUENCE empresa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE socio_id_seq CASCADE');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE socio');
    }
}
