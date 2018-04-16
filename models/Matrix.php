<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 10:09
 */

class Matrix
{
    public static function GoBack() {
        return $_SERVER['HTTP_REFERER'];
    }
    public static function saveFile($filename){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO files (filename) VALUES (:filename)";

        $db = $connect->prepare($sql);
        $db->bindParam(":filename",$filename, PDO::PARAM_STR);

        if($db->execute())
            return $connect->lastInsertId();
        return false;
    }
    public static function setFileStatus($id){
        $connect = DataBase::getConnection();
        $sql = "UPDATE files SET status = 'old' WHERE id < :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id",$id, PDO::PARAM_STR);

        if($db->execute())
            return true;
        return false;
    }
    public static function getCurrentFileName(){
        $connect = DataBase::getConnection();
        $sql = "SELECT filename FROM files WHERE status = 'current'";

        $db = $connect->query($sql);
        $db->execute();
        if($result = $db->fetch())
            return $result['filename'];
        return false;
    }
}