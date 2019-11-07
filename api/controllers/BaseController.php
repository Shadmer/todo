<?php

namespace controllers;

abstract class BaseController
{
    protected $pdo;
    protected $model;
    protected $db;

    public function __construct($db, $model)
    {
        $this->db = $db;
        $this->model = $model;
        $this->pdo = new $this->model($db);
    }

    public function actionIndex()
    {
        echo json_encode($this->pdo->getAll());
        exit;
    }

    public function actionAdd()
    {
        echo json_encode($this->pdo->add($_POST));
        exit;
    }

    public function actionDelete($id)
    {
        echo json_encode($this->pdo->delete($id));
        exit;
    }

    public function actionEdit($id)
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        echo json_encode($this->pdo->edit($id, $_PUT));
        exit;
    }
}