<?php

namespace Chrisguitarguy\CliMigrationExample\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Chrisguitarguy\CliMigrationExample\CliMigration;
use Chrisguitarguy\CliMigrationExample\SleepCommand;

class Version00000000000001 extends CliMigration
{
    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'A migration with CLI commands';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addCommand(new SleepCommand(5));
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addCommand(new SleepCommand(4));
    }
}
