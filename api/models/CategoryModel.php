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
        $sql = "INSERT INTO `categories` (title) VALUES (:title)";
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
        $sql = "UPDATE `categories` SET `title`= :title WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
        ]);
        return [
            'id' => (int)$id,
            'title' => $data['title'],
        ];
    }
}
