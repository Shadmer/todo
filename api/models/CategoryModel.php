<?php

namespace models;

class CategoryModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'categories');
    }

    public function add($data)
    {
        $sql = "INSERT INTO `categories` (title, user_id) VALUES (:title, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'user_id' => $this->user_id,
        ]);

        $id = (int)$this->db->lastInsertId();

        return [
            'id' => (int)$id,
        ];
    }

    public function edit($id, $data)
    {
        $sql = "UPDATE `categories` SET `title`= :title WHERE id = :id and user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'user_id' => $this->user_id,
        ]);
        return [
            'id' => (int)$id,
            'title' => $data['title'],
            'user_id' => $this->user_id,
        ];
    }
}
