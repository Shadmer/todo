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
}
