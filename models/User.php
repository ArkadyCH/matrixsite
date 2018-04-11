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

        if($db->execute())
            return $connect->lastInsertId();
        return 0;
    }
    public static function getImage($id){
        $path = '/upload/images/user/';
        $noImage = $path.'noimage.jpg';
        $pathToUserImage = $path.$id.'.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToUserImage)){
            return $pathToUserImage;
        }
        return $noImage;
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
    public static function getUserNameById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return $result['name'];
        return false;
    }
    public static function getUserById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        $result = array();

        while($row = $db->fetch()){
            $result['id'] = $row['id'];
            $result['name'] = $row['name'];
            $result['email'] = $row['email'];
        }
        return $result;
    }
    public static function getUserPermission($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT permission FROM users WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return $result['permission'];
        return false;
    }
    public static function updateUser($id , $name , $email){
        $connect = DataBase::getConnection();
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->bindParam(':name' , $name , PDO::PARAM_STR);
        $db->bindParam(':email' , $email , PDO::PARAM_STR);

        if($db->execute())
            return true;
        return false;
    }
    public static function updateUserPassword($id , $password){
        $password= password_hash($password,PASSWORD_DEFAULT);
        $connect = DataBase::getConnection();
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->bindParam(':password' , $password , PDO::PARAM_STR);

        if($db->execute())
            return true;
        return false;
    }
    public static function checkPassword($id , $password){
        $connect = DataBase::getConnection();
        $sql = "SELECT password FROM users WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        $result = $db->fetch();
        if(password_verify($password , $result['password']))
            return true;
        return false;
    }
}