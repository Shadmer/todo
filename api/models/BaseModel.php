<?php

namespace models;

abstract class BaseModel
{
    protected $db;
    protected $table;

    public function __construct(\PDO $db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->query($sql);

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
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        return $stmt->fetch();

    }


    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        return [
            'id' => (int)$id
        ];
    }
}
