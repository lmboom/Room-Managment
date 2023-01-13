<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . 'vendor/autoload.php';

CONST APP_NAME = 'Room Management';

use RoomManagment\Cli\Application;

$application = new Application(APP_NAME, fn() => print_r('Application is closed.', true) );

$application->run();