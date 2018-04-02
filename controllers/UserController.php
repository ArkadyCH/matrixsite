<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 10:08
 */

class UserController
{
    public function actionLogin(){
        require_once(ROOT . '/views/auth/login.php');
        return true;
    }
    public function actionSign(){
        require_once(ROOT . '/views/auth/sign.php');
        return true;
    }
}