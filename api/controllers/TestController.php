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