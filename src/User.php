<?php

namespace RoomManagment\Cli;

class User extends Model
{
    private string $table = 'users';

    public function createUser($data): object
    {
        return (bool)$result;
    }

    public function isUserExist($userId): bool
    {
        $sql  = $this->db->escapeString("
                SELECT * FROM 
                             {$this->table} 
                WHERE id = {$userId}");
        $user = $this->db->querySingle($sql);

        return (bool)$user;
    }


}