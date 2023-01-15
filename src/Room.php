<?php

namespace RoomManagment\Cli;


class Room extends Model
{
    private string $table = 'room_reservations';

    public function isRoomHold($roomId, $time): bool
    {
        $time   = strtotime($time);
        $sql    = $this->db->escapeString("
                SELECT * FROM 
                             {$this->table} 
                WHERE room_id = {$roomId} and hold_from < {$time} and hold_to > {$time}");
        $result = $this->db->querySingle($sql);

        return (bool)$result;
    }

}