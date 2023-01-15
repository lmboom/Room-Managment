<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\User;
use RoomManagment\Cli\Room;
use RoomManagment\Cli\Utils\Output;
use RoomManagment\Cli\Interfaces\ICommand;
use RoomManagment\Cli\Exceptions\UserNotFoundException;

class HoldRoomCommand extends Command implements ICommand
{
    public function handle($userId, $timeFrom, $timeTo): Output
    {
        $user = (new User())->getUser($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }

        (new Room())->holdRoom([
            'user_id'   => $userId,
            'hold_from' => strtotime($timeFrom),
            'hold_to'   => strtotime($timeTo),
        ]);

        return new Output("Reservation is complete by {$user['username']}. Time: $timeFrom - $timeTo");
    }
}