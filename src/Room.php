<?php

namespace RoomManagment\Cli;


use RoomManagment\Cli\Exceptions\InvalidArgumentException;

class Room extends Model
{
    private string $table = 'room_reservations';

    public function isRoomHold($roomId, $timeFrom, $timeTo): array
    {
        $timeFrom   = strtotime($timeFrom);
        $timeTo     = strtotime($timeTo);

        $sql    = $this->db->escapeString("
                SELECT * FROM 
                             {$this->table} 
                WHERE room_id = {$roomId} and (
                    ({$timeTo} >= hold_from and {$timeFrom}<= hold_to)
                )"
        );

        return $this->db->querySingle($sql, true);
    }

    public function holdRoom(array $data): int
    {
        if ($data['hold_from'] >= $data['hold_to']) {
            throw new InvalidArgumentException('Wrong time condition');
        }
        $this->db->exec("
                     INSERT INTO 
                         {$this->table} (room_id, user_id, hold_from, hold_to) 
                     VALUES({$data['room_id']},{$data['user_id']}, {$data['hold_from']}, {$data['hold_to']})");

        return $this->db->lastInsertRowID();
    }

}