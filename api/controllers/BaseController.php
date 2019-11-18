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

    public function actionGet() {
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