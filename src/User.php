<?php

namespace RoomManagment\Cli;

class User extends Model
{
    private string $table = 'users';

    public function createUser($username, $email, $phone): int
    {
        $this->db->exec("
                     INSERT INTO 
                         {$this->table} (username, email, phone) 
                     VALUES('{$username}', '{$email}', '{$phone}')");

        return $this->db->lastInsertRowID();
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