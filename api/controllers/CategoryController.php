<?php

namespace controllers;

class CategoryController extends BaseController
{
    public function __construct($db)
    {
        parent::__construct($db, "\models\CategoryModel");
    }
}