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

    public function holdRoom(array $data): bool
    {
        $sql    = $this->db->escapeString("
                     INSERT INTO 
                         {$this->table} (user_id, time_from, time_to) 
                     VALUES({$data['user_id']}, {$data['time_from']}, {$data['time_to']})");
        return $this->db->exec($sql);
    }

}