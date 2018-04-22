<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 15.04.2018
 * Time: 19:01
 */

class Admin
{
    public static function isAdmin(){
        $connect = DataBase::getConnection();
        $sql = "SELECT permission FROM users WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $_SESSION['user_id'] , PDO::PARAM_STR);
        $db->execute();
        $result = $db->fetch();
        if($result['permission'] == 'admin'){
            return true;
        }
        return false;
    }
}