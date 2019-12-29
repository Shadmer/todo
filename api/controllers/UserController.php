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

        if (!isset($_SESSION['user'])) {
            $user = [
                'id' => null,
                'login' => null
            ];
            echo json_encode($user);
            die;
        }

        if ($_SESSION['user'] === 0) {
            $user = [
                'id' => 0,
                'login' => 'Developer'
            ];
            echo json_encode($user);
            die;
        }

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
        echo json_encode($data);
    }

    public function actionAuth()
    {
        $data = $this->pdo->auth($_POST);
        if (!$data) {
            $this->helpers->throwHttpError('wrong_login_or_password', 'wrong login or password');
            die;
        }

        $_SESSION['user'] = $data['id'];
        echo json_encode($data);
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
    }
}