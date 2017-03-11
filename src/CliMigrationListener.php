<?php

namespace Chrisguitarguy\CliMigrationExample;

use Doctrine\Common\EventSubscriber;
use Doctrine\DBAL\Migrations\Events;
use Doctrine\DBAL\Migrations\OutputWriter;
use Doctrine\DBAL\Migrations\Version;
use Doctrine\DBAL\Migrations\Event\MigrationsVersionEventArgs as VersionArgs;

class CliMigrationListener implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            Events::onMigrationsVersionExecuted,
        ];
    }

    public function onMigrationsVersionExecuted(VersionArgs $args)
    {
        $version = $args->getVersion();
        $migration = $version->getMigration();
        if (!$migration instanceof CliMigration) {
            return;
        }

        $config = $args->getConfiguration();
        $output = $config->getOutputWriter();
        $dir = $args->getDirection() === Version::DIRECTION_UP ? '++' : '--';

        $output->write(sprintf('  <info>%s</info> Executing CLI Commands%s', $dir, PHP_EOL));
        foreach ($migration->getCommands() as $command) {
            $this->runCommand($command, $output);
        }
        $output->write(sprintf('  <info>%s</info> Executed CLI Commands%s', $dir, PHP_EOL));
    }

    private function runCommand(CliMigrationCommand $cmd, OutputWriter $output)
    {
        $proc = $cmd->toProcess();
        $prefix = sprintf('    <comment>-></comment> %s: ', $cmd);

        $output->write(sprintf(
            '%sExecuting %s%s',
            $prefix,
            $proc->getCommandLine(),
            PHP_EOL
        ));

        $proc->mustRun(function ($_, $buf) use ($output, $prefix) {
            $output->write($prefix.$buf);
        });
    }
}
