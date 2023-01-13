<?php

namespace RoomManagment\Cli\Commands;

class HoldRoomCommand extends Command implements ICommand
{
    public function handle($roomId, $time): bool
    {
        $room = $this->roomRepository->create($roomId, [
            'is_hold' => true,
            'hold_time' => $time
        ]);
        return $room->is_hold;
    }
}