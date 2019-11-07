<?php

namespace controllers;

class TaskController extends BaseController
{

    public function __construct($db)
    {
        parent::__construct($db, "\models\TaskModel");
    }

    public function actionDeleteByCategoryId($id)
    {
        echo json_encode($this->pdo->deleteByCategoryId($id));
        exit;
    }

    public function actionDeleteCompletedTasks($id)
    {
        echo json_encode($this->pdo->deleteCompletedTasks($id));
        exit;
    }

}
