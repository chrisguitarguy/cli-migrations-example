<?php

namespace Chrisguitarguy\CliMigrationExample;

use Symfony\Component\Process\Process;

interface CliMigrationCommand
{
    public function toProcess() : Process;

    public function __toString() : string;
}
