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
        $sql = "INSERT INTO `tasks` (task) VALUES (:task)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'task' => $data['task'],
        ]);
        return $data;
    }

    public function edit($id, $data)
    {
        $sql = "UPDATE `tasks` SET `task`= :task WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'task' => $data['task'],
        ]);
        return $id;
    }
}
