<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\User;
use RoomManagment\Cli\Utils\Output;
use RoomManagment\Cli\Interfaces\ICommand;

class CreateUserCommand extends Command implements ICommand
{
    public string $executeExample = 'php index.php alias=create-user username={} email={} phone={}';
    public function handle($username, $email, $phone): Output
    {
        $userId = (new User())->createUser($username, $email, $phone);

        return new Output("User has been successfully created. UserId: $userId");
    }
}