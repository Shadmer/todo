<?php

namespace controllers;

abstract class BaseController
{
    protected $db;
    protected $helpers;
    protected $model;
    protected $pdo;

    public function __construct($db, $helpers, $model)
    {
        $this->db = $db;
        $this->helpers = $helpers;
        $this->model = $model;
        $this->pdo = new $this->model($db);

        if ($this->model !== '\models\UserModel' && !isset($_SESSION['user'])) {
            $this->helpers->throwHttpError('400', 'no_authorization');
            die;
        }
    }

    public function actionGet()
    {
        echo json_encode($this->pdo->getAll());
    }

    public function actionAdd()
    {
        echo json_encode($this->pdo->add($_POST));
    }

    public function actionDelete($id)
    {
        echo json_encode($this->pdo->delete($id));
    }

    public function actionEdit($id, $data)
    {
        echo json_encode($this->pdo->edit($id, $data));
    }
}