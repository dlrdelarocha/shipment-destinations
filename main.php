<?php

require_once 'vendor/autoload.php';

use App\Commands\AssignShipmentsCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new AssignShipmentsCommand());
try {
    $application->run();
} catch (Exception $e) {
}




