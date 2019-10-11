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
        $sql = "INSERT INTO `tasks` (title, category_id) VALUES (:title, :category_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
        ]);

        $id = (int)$this->db->lastInsertId();

        return [
            'id' => (int)$id,
        ];
    }

    public function edit($id, $data)
    {
        $sql = "UPDATE `tasks` SET `title`= :title, `category_id`= :category_id, `completed` = :completed WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'completed' => $data['completed'],
        ]);
        return [
            'id' => (int)$id,
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'completed' => $data['completed'],
        ];
    }

    public function deleteByCategoryId($id)
    {
        $sql = "DELETE FROM `tasks` WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'category_id' => $id,
        ]);
        return [
            'id' => (int)$id
        ];
    }
}
