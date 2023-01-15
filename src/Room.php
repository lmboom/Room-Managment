<?php

namespace RoomManagment\Cli;


use RoomManagment\Cli\Exceptions\InvalidArgumentException;

class Room extends Model
{
    private string $table = 'room_reservations';

    public function isRoomReserved($roomId, $timeFrom, $timeTo): array
    {
        $timeFrom   = strtotime($timeFrom);
        $timeTo     = strtotime($timeTo);

        $sql    = $this->db->escapeString("
                SELECT * FROM 
                             {$this->table} 
                WHERE room_id = {$roomId} and (
                    ({$timeTo} >= reserve_from and {$timeFrom}<= reserve_to)
                )"
        );

        return $this->db->querySingle($sql, true);
    }

    public function reserveRoom(array $data): int
    {
        if ($data['reserve_from'] >= $data['reserve_to']) {
            throw new InvalidArgumentException('Wrong time condition');
        }
        $this->db->exec("
                     INSERT INTO 
                         {$this->table} (room_id, user_id, reserve_from, reserve_to) 
                     VALUES({$data['room_id']},{$data['user_id']}, {$data['reserve_from']}, {$data['reserve_to']})");

        return $this->db->lastInsertRowID();
    }

}