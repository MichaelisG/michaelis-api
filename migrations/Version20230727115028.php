<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727115028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '[Foo] Crete Table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE foo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE foo (id INT NOT NULL, code VARCHAR(16) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE foo_id_seq CASCADE');
        $this->addSql('DROP TABLE foo');
    }
}
