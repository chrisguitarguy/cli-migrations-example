<?php

namespace Chrisguitarguy\CliMigrationExample;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

final class SleepCommand implements CliMigrationCommand
{
    private $seconds;

    public function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    public function toProcess() : Process
    {
        return ProcessBuilder::create()
            ->setPrefix('/bin/sleep')
            ->add($this->seconds)
            ->getProcess();
    }

    public function __toString() : string
    {
        return sprintf('SleepCommand(seconds=%d)', $this->seconds);
    }
}
