<?php

return [
    'task/task' => 'task/index',
    'task/add' => 'task/add',
    'task/delete/category/([0-9]+)' => 'task/deleteByCategoryId/$1',
    'task/delete/completed/([0-9]+)' => 'task/deleteCompletedTasks/$1',
    'task/delete/([0-9]+)' => 'task/delete/$1',
    'task/edit/([0-9]+)' => 'task/edit/$1',
    'task' => 'task/get',

    'category/category' => 'category/index',
    'category/add' => 'category/add',
    'category/delete/([0-9]+)' => 'category/delete/$1',
    'category/edit/([0-9]+)' => 'category/edit/$1',
    'category' => 'category/get',
];