<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 26.11.2019
 * Time: 14:15
 */

namespace models;


class UserModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'users');
    }

    public function add($data)
    {
        $sql = "INSERT INTO `users` (login, password) VALUES (:login, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $data['login'],
            'password' => $data['password'],
        ]);

        $id = (int)$this->db->lastInsertId();

        return [
            'id' => (int)$id,
        ];
    }
}