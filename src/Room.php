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

    public function holdRoom(array $data): int
    {
        $this->db->exec("
                     INSERT INTO 
                         {$this->table} (user_id, hold_from, hold_to) 
                     VALUES({$data['user_id']}, {$data['hold_from']}, {$data['hold_to']})");

        return $this->db->lastInsertRowID();
    }

}