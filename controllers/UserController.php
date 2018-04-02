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
        $params = array();
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }
            User::checkUser($params);
        }

        require_once(ROOT . '/views/auth/login.php');
        return true;
    }
    public function actionSign(){
        $params = array();
        $params['name'] = '';
        $params['email'] = '';
        $params['password'] = '';
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }
            $errors = false;
            if(!User::validateName($params['name'])){
                $errors[] = 'Логин не должен быть пустым и его длина должна быть не меньше 6 символов';
            }
            if(!User::validatePassword($params['password'])){
                $errors[] = 'Пароль должен быть > или = 7 символов, а также иметь хотябы 1-у заглавную букву';
            }
            if(User::validateEmail($params['email'])){
                $errors[] = 'Такой E-mail уже зарегистрирован';
            }
            if(!User::validateConfirmPassword($params['password'],$params['confirm_password'])){
                $errors[] = 'Пароли не совпадают';
            }
            if(!$errors){
                User::createUser($params);
                $result = true;
            }
        }

        require_once(ROOT . '/views/auth/sign.php');
        return true;
    }
}