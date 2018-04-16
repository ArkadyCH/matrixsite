<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 10:09
 */

class Matrix
{
    public static function GoBack()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public static function saveFile($filename)
    {
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO files (filename) VALUES (:filename)";

        $db = $connect->prepare($sql);
        $db->bindParam(":filename", $filename, PDO::PARAM_STR);

        if ($db->execute())
            return $connect->lastInsertId();
        return false;
    }

    public static function setFileStatus($id)
    {
        $connect = DataBase::getConnection();
        $sql = "UPDATE files SET status = 'old' WHERE id < :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id", $id, PDO::PARAM_STR);

        if ($db->execute())
            return true;
        return false;
    }

    public static function getCurrentFile()
    {
        $connect = DataBase::getConnection();
        $sql = "SELECT id FROM files WHERE status = 'current'";

        $db = $connect->query($sql);
        $db->execute();

        if ($row = $db->fetch())
            $string_to_search = $row['id'];

        $dir = opendir($_SERVER['DOCUMENT_ROOT'] . "/upload/softs/");

        while (($file = readdir($dir)) !== false) {
            $filename = strstr($file, $string_to_search);
        }
        $result['id'] = $string_to_search;
        $result['filename'] = $filename;
        return $result;
    }

    public static function setFileStats($user_id, $count, $file_id)
    {
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO stats (user_id,count,file_id) VALUES (:user_id,:cout,:file_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $db->bindParam(":cout", $count, PDO::PARAM_STR);
        $db->bindParam(":file_id", $file_id, PDO::PARAM_STR);

        if ($db->execute())
            return true;
        return false;
    }

    public static function checFileStats($user_id, $file_id)
    {
        $connect = DataBase::getConnection();
        $sql = "SELECT count FROM stats WHERE user_id = :user_id AND file_id = :file_id";

        $db = $connect->prepare($sql);
        $db->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $db->bindParam(":file_id", $file_id, PDO::PARAM_STR);
        $db->execute();

        if ($result = $db->fetch())
            return $result['count'];
        return false;
    }

    public static function updateFileStats($id, $user_id, $count)
    {
        $connect = DataBase::getConnection();
        $sql = "UPDATE stats SET count = :count WHERE file_id = :id AND user_id = :user_id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id", $id, PDO::PARAM_STR);
        $db->bindParam(":count", $count, PDO::PARAM_STR);
        $db->bindParam(":user_id", $user_id, PDO::PARAM_STR);

        if ($db->execute())
            return true;
        return false;
    }

    public static function getFileStats($id)
    {
        $connect = DataBase::getConnection();
        $sql = "SELECT count , user_id , data FROM stats WHERE file_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id", $id, PDO::PARAM_STR);
        $db->execute();

        if ($result = $db->fetchAll())
            return $result;
        return false;
    }
}