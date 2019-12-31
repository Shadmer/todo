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
        $sql = "SELECT id, login FROM `users` WHERE id = :id";
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
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $id = (int)$this->db->lastInsertId();

        return [
            'id' => (int)$id,
        ];
    }

    public function auth($data)
    {
        $sql = "SELECT * FROM `users` WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $data['login'],
        ]);
        $user = $stmt->fetch();

        //todo это вообще нормально?
        if (password_verify($data['password'], $user['password']) || $data['password'] === $user['password']) {
            return $user;
        } else {
            return false;
        }
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