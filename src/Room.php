<?php

namespace RoomManagment\Cli;


//some kind of Model/Entity mix. Sorry
use SQLite3;

class Room
{

    private readonly SQLite3 $db;
    private string           $table = 'room_hold';

    public function __construct()
    {
        $this->db = new SQLite3('test.db');
    }

    public function isRoomHold($roomId, $time): bool
    {
        $sql    = $this->db->escapeString("SELECT * FROM {$this->table} WHERE room_id = {$roomId} and time = {$time}");
        $result = $this->db->query($sql);
dd($result);

    }

}