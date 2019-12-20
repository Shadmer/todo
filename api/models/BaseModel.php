<?php

namespace models;

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $user_id;

    public function __construct(\PDO $db, $table)
    {
        $this->db = $db;
        $this->table = $table;
        $this->user_id = $_SESSION['user'];
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id' => $this->user_id,
        ]);
//        $tasks = [];
//        while ($row = $stmt->fetch())
//        {
//            $tasks[] = $row;
//        }
//        return $tasks;

        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id and user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'user_id' => $this->user_id,
        ]);
        return $stmt->fetch();

    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id and user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'user_id' => $this->user_id,
        ]);
        return [
            'id' => (int)$id
        ];
    }
}
