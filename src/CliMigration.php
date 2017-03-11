<?php

namespace Chrisguitarguy\CliMigrationExample;

use Doctrine\DBAL\Migrations\AbstractMigration;

abstract class CliMigration extends AbstractMigration
{
    private $commands = [];

    protected function addCommand(CliMigrationCommand $cmd)
    {
        $this->commands[] = $cmd;
    }

    public function getCommands()
    {
        return $this->commands;
    }
}
