<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 18:22
 */

class Message
{
    public static function saveMessage($text , $from_id , $to_id ){
        $connect = DataBase::getConnection();
        date_default_timezone_set('Europe/Moscow');
        $date = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO personal_messages (text , from_user_id , to_user_id , date)".
            " VALUES (:text,:from_id,:to_id,:date)";

        $db = $connect->prepare($sql);
        $db->bindParam(':text' , $text , PDO::PARAM_STR);
        $db->bindParam(':from_id' , $from_id , PDO::PARAM_STR);
        $db->bindParam(':to_id' , $to_id , PDO::PARAM_STR);
        $db->bindParam(':date' , $date , PDO::PARAM_STR);

        return $db->execute();
    }
    public static function getUserIdByMessageId($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT DISTINCT from_user_id FROM personal_messages WHERE to_user_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id" , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getPersonalMessages($from , $to){
        $connect = DataBase::getConnection();
        $sql = "SELECT text,date,from_user_id FROM personal_messages WHERE from_user_id = :from AND to_user_id = :to OR from_user_id = :to AND to_user_id = :from";

        $db = $connect->prepare($sql);
        $db->bindParam(":from" , $from , PDO::PARAM_STR);
        $db->bindParam(":to" , $to , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
}