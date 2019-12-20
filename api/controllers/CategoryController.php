<?php

namespace controllers;

class CategoryController extends BaseController
{
    public function __construct($db, $helpers)
    {
        parent::__construct($db, $helpers, "\models\CategoryModel");
    }
}