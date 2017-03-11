<?php

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Chrisguitarguy\CliMigrationExample\CliMigrationListener;

$conn = DriverManager::getConnection([
    'url' => 'mysql://root@localhost/climigrationexample',
]);
$conn->getEventManager()->addEventSubscriber(new CliMigrationListener());

return new HelperSet([
    'db' => new ConnectionHelper($conn),
]);
