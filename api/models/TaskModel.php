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
        $sql = "INSERT INTO `tasks` (title) VALUES (:title)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
        ]);

        $id = (int)$this->db->lastInsertId();

        return [
            'id' => (int)$id,
        ];
    }

    public function edit($id, $data)
    {
        $sql = "UPDATE `tasks` SET `title`= :title, `completed` = :completed WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'completed' => $data['completed'],
        ]);
        return [
            'id' => (int)$id,
            'title' => $data['title'],
            'completed' => $data['completed'],
        ];
    }
}
