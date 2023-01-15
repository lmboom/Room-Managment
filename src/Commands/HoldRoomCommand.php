<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\User;
use RoomManagment\Cli\Room;
use RoomManagment\Cli\Interfaces\ICommand;
use RoomManagment\Cli\Exceptions\UserNotFoundException;

class HoldRoomCommand extends Command implements ICommand
{
    public function handle($userId, $timeFrom, $timeTo): bool
    {
        $user = (new User())->isUserExist($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return (new Room())->holdRoom([
            'user_id'   => $userId,
            'hold_from' => strtotime($timeFrom),
            'hold_to'   => strtotime($timeTo),
        ]);
    }
}