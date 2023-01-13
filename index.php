<?php
if (php_sapi_name() !== 'cli') {
    exit;
}
require 'vendor/autoload.php';


use RoomManagment\Cli\Application;
use RoomManagment\Cli\Commands\HoldRoomCommand;
use RoomManagment\Cli\Commands\RoomStatusCommand;
const APP_NAME = 'Room Management';

$application = new Application(APP_NAME, fn () => print_r('Application is closed.', true));

$holdRoomCommand   = new HoldRoomCommand('hold-room');
$roomStatusCommand = new RoomStatusCommand('room-status');

$application->addCommand($holdRoomCommand);
$application->addCommand($roomStatusCommand);

$application->handle($argv);
