<?php

namespace controllers;

use \core\DB;
use \models\TaskModel;

class TestController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new TaskModel(DB::connect());
    }

    public function actionIndex()
    {
        //todo (?) все запросы на индекс, а здесь распределеине по другим экшенам
    }

    public function actionGet()
    {
        echo json_encode($this->pdo->getAll());
        return true;
    }

    public function actionAdd()
    {
        $this->pdo->add($_POST);
        return true;
    }

    public function actionDelete($id)
    {
        $this->pdo->delete($id);
        return $id;
    }

    public function actionEdit($id)
    {
        $this->pdo->edit($id, $_POST);
        return $id;
    }

}