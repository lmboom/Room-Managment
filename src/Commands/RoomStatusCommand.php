<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\Room;
use RoomManagment\Cli\Interfaces\ICommand;

class RoomStatusCommand extends Command implements ICommand
{

    public function handle($roomId, $time): bool
    {
        $roomModel = (new Room())->isRoomHold($roomId, $time);
    }
}