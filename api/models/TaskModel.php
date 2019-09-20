<?php

namespace models;

class TaskModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'tasks');
    }

    public function add($data)
    {
        $sql = "INSERT INTO $this->table (task, is_folder) VALUES (:task, :is_folder)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'task' => $data['task'],
            'is_folder' => $data['is_folder'],
        ]);
        return $data;
    }

    public function edit($id, $data)
    {

    }
}
