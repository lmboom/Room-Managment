<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\User;
use RoomManagment\Cli\Room;
use RoomManagment\Cli\Utils\Output;
use RoomManagment\Cli\Interfaces\ICommand;
use RoomManagment\Cli\Exceptions\UserNotFoundException;

class HoldRoomCommand extends Command implements ICommand
{
    public string $executeExample = 'php index.php alias=hold-room roomId={} userId={} timeFrom="{}" timeTo="{}"';

    public function handle($roomId, $userId, $timeFrom, $timeTo): Output
    {
        $user = (new User())->getUser($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }

        $isRoomReserved = (new Room())->isRoomHold($roomId, $timeFrom, $timeTo);

        if ($isRoomReserved) {
            $reservedRoomUser = (new User())->getUser($isRoomReserved['user_id']);
            $timeFrom         = date('d M Y H:i', $isRoomReserved['hold_from']);
            $timeTo           = date('d M Y H:i', $isRoomReserved['hold_to']);

            return new Output("Room has been already reserved by {$reservedRoomUser['username']}.\nReservation Period: $timeFrom - $timeTo ");
        }

        (new Room())->holdRoom([
            'user_id'   => $userId,
            'room_id'   => $roomId,
            'hold_from' => strtotime($timeFrom),
            'hold_to'   => strtotime($timeTo),
        ]);


        $timeFromFormatted = date('d M Y H:i', strtotime($timeFrom));
        $timeToFormatted   = date('d M Y H:i', strtotime($timeTo));
        return new Output("Reservation is complete by {$user['username']}. Period: $timeFromFormatted - $timeToFormatted");
    }
}