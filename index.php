<?php
if (php_sapi_name() !== 'cli') {
    exit;
}
require 'vendor/autoload.php';


use RoomManagment\Cli\Application;
use RoomManagment\Cli\Utils\Input;
use RoomManagment\Cli\Commands\HoldRoomCommand;
use RoomManagment\Cli\Commands\RoomStatusCommand;
use RoomManagment\Cli\Exceptions\InvalidArgumentException;

const APP_NAME = 'Room Management';

$application = new Application(APP_NAME, fn () => print_r('Bye.', true));

$holdRoomCommand   = new HoldRoomCommand('hold-room');
$roomStatusCommand = new RoomStatusCommand('room-status');

$application->addCommand($holdRoomCommand);
$application->addCommand($roomStatusCommand);

$input = new Input($argv);
if ($input->argumentsCount() < 2) {
    $application->showHelpWithMessage('Not enough arguments');
}

try {
    $output = $application->handle($input);
} catch (InvalidArgumentException $e) {
    $application->showHelpWithMessage($e->getMessage());
}
