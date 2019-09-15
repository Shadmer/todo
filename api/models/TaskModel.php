<?php

namespace models;

class TaskModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'tasks');
    }

    public function add($id, $data)
    {

    }

    public function edit($id, $data)
    {

    }
}
