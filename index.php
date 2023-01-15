<?php
if (php_sapi_name() !== 'cli') {
    exit;
}
require 'vendor/autoload.php';


use RoomManagment\Cli\Application;
use RoomManagment\Cli\Utils\Input;
use RoomManagment\Cli\Commands\CreateUserCommand;
use RoomManagment\Cli\Commands\ReserveRoomCommand;
use RoomManagment\Cli\Exceptions\UserNotFoundException;
use RoomManagment\Cli\Exceptions\InvalidArgumentException;

const APP_NAME = 'Room Management';

$application = new Application(APP_NAME, fn () => dd('Bye.', true));

$reserveRoomCommand = new ReserveRoomCommand('reserve-room');
$createUserCommand  = new CreateUserCommand('create-user');

$application->addCommand($reserveRoomCommand);
$application->addCommand($createUserCommand);

$input = new Input($argv);
if ($input->argumentsCount() < 2) {
    dd('Not enough arguments');
}

try {
    $output = $application->handle($input);
    dd($output->getMessage());
} catch (InvalidArgumentException $e) {
    dd($e->getMessage());
} catch (UserNotFoundException $e) {
    dd("User not found. Please create user before reserve room.\nuse '{$createUserCommand->executeExample}' to create user");
}
