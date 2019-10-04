<?php

return [
    'task/task' => 'task/index',
    'task/add' => 'task/add',
    'task/delete/([0-9]+)' => 'task/delete/$1',
    'task/edit/([0-9]+)' => 'task/edit/$1',
    'task' => 'task/get',
];