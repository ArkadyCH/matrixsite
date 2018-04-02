<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 10:09
 */

class User
{
    public static function checkUser($params){
        $connect = DataBase::getConnection();
        $sql = "SELECT password,id FROM users WHERE email = :email";

        $db = $connect->prepare($sql);
        $db->bindParam(':email', $params['email'], PDO::PARAM_STR);
        $db->execute();

        $result = $db->fetch();

        if(password_verify($params['password'],$result['password']))
            return $result['id'];
        return false;
    }
    public static function createUserSession($user_id){
        $_SESSION['user_id'] = $user_id;
    }
    public static function checkUserSession(){
        if(isset($_SESSION['user_id']))
            return $_SESSION['user_id'];
        return false;
    }
    public static function destroyUserSession(){
        if(isset($_SESSION['user_id']))
            unset($_SESSION['user_id']);
    }
    public static function createUser($params)
    {
        $params['password'] = password_hash($params['password'],PASSWORD_DEFAULT);

        $connect = DataBase::getConnection();
        $sql = "INSERT INTO users (name,email,password) VALUES(:name,:email,:password)";

        $db = $connect->prepare($sql);
        $db->bindParam(':name', $params['name'], PDO::PARAM_STR);
        $db->bindParam(':email', $params['email'], PDO::PARAM_STR);
        $db->bindParam(':password', $params['password'], PDO::PARAM_STR);

        return $db->execute();
    }

    public static function validateName($name)
    {
        if (mb_strlen($name) > 6)
            return true;
        return false;
    }
    public static function validatePassword($password)
    {
        if (strlen($password) >= 7 && !ctype_upper($password) && !ctype_lower($password) && !ctype_space($password))
            return true;
        return false;
    }
    public static function validateEmail($email)
    {
        $connect = DataBase::getConnection();
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";

        $db = $connect->prepare($sql);
        $db->bindParam(':email', $email, PDO::PARAM_STR);
        $db->execute();

        if($db->fetchColumn())
            return true;
        return false;
    }
    public static function validateConfirmPassword($password , $confirmPassword){
        if($password == $confirmPassword)
            return true;
        return false;
    }
}