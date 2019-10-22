<?php

namespace controllers;

use \core\DB;
use \models\CategoryModel;

class CategoryController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new CategoryModel(DB::connect());
    }

    public function actionIndex()
    {

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