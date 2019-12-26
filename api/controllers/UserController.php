<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 26.11.2019
 * Time: 14:14
 */

namespace controllers;


class UserController extends BaseController
{
    public function __construct($db, $helpers)
    {
        parent::__construct($db, $helpers, "\models\UserModel");
    }

    public function actionGetUser()
    {
        $user = $this->pdo->getUser($_SESSION['user']);
        unset($user['password']);
        echo json_encode($user);
    }

    public function actionRegistration()
    {
        $checkLogin = $this->pdo->checkLoginExist($_POST);
        if ($checkLogin) {
            $this->helpers->throwHttpError('login_exists', 'login exists');
            die;
        }

        $data = $this->pdo->registration($_POST);
//        $_SESSION['user'] = $data['id'];
        echo json_encode($data);
    }

    public function actionAuth()
    {
        $data = $this->pdo->auth($_POST);

        if ($data) {
            $_SESSION['user'] = $data['id'];
            echo json_encode($data);
        } else {
            $this->helpers->throwHttpError('wrong_login_or_password', 'wrong login or password');
            die;
        }
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
    }
}