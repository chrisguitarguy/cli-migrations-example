<?php

namespace Chrisguitarguy\CliMigrationExample\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version00000000000000 extends AbstractMigration
{
    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'A normal migration, no commands';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE example (one INT)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE example');
    }
}
