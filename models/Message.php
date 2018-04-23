<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 18:22
 */

class Message
{
    public static function saveMessage($text , $send ,$dialog_id){
        $connect = DataBase::getConnection();
        date_default_timezone_set('Europe/Moscow');
        $date = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO messages (user_id , text , date , dialog_id)".
            " VALUES (:send,:text,:date,:dialog_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(':send' , $send , PDO::PARAM_STR);
        $db->bindParam(':text' , $text , PDO::PARAM_STR);
        $db->bindParam(':date' , $date , PDO::PARAM_STR);
        $db->bindParam(':dialog_id' , $dialog_id , PDO::PARAM_STR);

        return $db->execute();
    }
    public static function getUserIdByMessageId($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT DISTINCT from_user_id FROM personal_messages WHERE to_user_id = :id ORDER BY from_user_id DESC";

        $db = $connect->prepare($sql);
        $db->bindParam(":id" , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getPersonalMessages($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT user_id,text,date FROM messages WHERE dialog_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id" , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function saveDialog($send , $recive){
        $connect = DataBase::getConnection();

        $sql = "INSERT INTO dialog (status , send , recive)".
            " VALUES (0,:send,:recive)";

        $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
        $db = $connect->prepare($sql);
        $db->bindParam(':send' , $send , PDO::PARAM_STR);
        $db->bindParam(':recive' , $recive , PDO::PARAM_STR);
        $db->execute();

        return $connect->lastInsertId();
    }
    public static function updateDialog($send , $recive){
        $connect = DataBase::getConnection();

        $sql = "UPDATE dialog SET send = :send , recive = :recive";

        $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
        $db = $connect->prepare($sql);
        $db->bindParam(':send' , $send , PDO::PARAM_STR);
        $db->bindParam(':recive' , $recive , PDO::PARAM_STR);
        $db->execute();

        $id = $connect->prepare("SELECT id FROM dialog WHERE send = :send AND recive = :recive OR send = :recive AND recive = :send");
        $id->bindParam(':send' , $send , PDO::PARAM_STR);
        $id->bindParam(':recive' , $recive , PDO::PARAM_STR);
        $id->execute();

        if($result = $id->fetch())
            return $result['id'];
        return false;
    }
    public static function getDialog($send , $recive){
        $connect = DataBase::getConnection();

        $sql = "SELECT * FROM dialog WHERE send = :send AND recive = :recive OR send = :recive AND recive = :send";

        $db = $connect->prepare($sql);
        $db->bindParam(':send' , $send , PDO::PARAM_STR);
        $db->bindParam(':recive' , $recive , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getAllDialog($recive){
        $connect = DataBase::getConnection();

        $sql = "SELECT * FROM dialog WHERE recive = :recive";

        $db = $connect->prepare($sql);
        $db->bindParam(':recive' , $recive , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
}