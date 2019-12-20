<?php

namespace controllers;

class TaskController extends BaseController
{

    public function __construct($db, $helpers)
    {
        parent::__construct($db, $helpers, "\models\TaskModel");
    }

    public function actionDeleteByCategoryId($id)
    {
        echo json_encode($this->pdo->deleteByCategoryId($id));
    }

    public function actionDeleteCompletedTasks($id)
    {
        echo json_encode($this->pdo->deleteCompletedTasks($id));
    }

}
