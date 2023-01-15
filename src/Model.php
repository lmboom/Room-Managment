<?php

namespace RoomManagment\Cli;

use SQLite3;


//some kind of Model/Entity mix. Sorry
class Model
{
    protected SQLite3 $db;

    public function __construct()
    {
        $this->db = new SQLite3('room_management.db');
    }
}