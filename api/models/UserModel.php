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

    public function getUser($id)
    {
        $sql = "SELECT * FROM `users` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        return $stmt->fetch();
    }

    public function registration($data)
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

    public function auth($data)
    {
        $sql = "SELECT * FROM `users` WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $data['login'],
            'password' => $data['password'],
        ]);

        return $stmt->fetch();
    }

    public function checkLoginExist($data)
    {
        $sql = "SELECT * FROM `users` WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $data['login'],
        ]);

        return $stmt->fetch();
    }
}