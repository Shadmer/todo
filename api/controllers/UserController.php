<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 26.11.2019
 * Time: 14:14
 */

namespace controllers;


class UserController extends BaseController
{
    public function __construct($db)
    {
        parent::__construct($db, "\models\UserModel");
    }
}