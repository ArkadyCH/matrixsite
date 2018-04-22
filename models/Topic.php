<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:54
 */

class Topic
{
    public static function saveTopic($title_name , $description , $parent_id , $user_id , $type_id , $lvl){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO forum (title_name , description , user_id , parent_id , type_id , lvl)".
            " VALUES (:title_name,:description,:user_id,:parent_id,:type_id,:lvl)";

        $db = $connect->prepare($sql);
        $db->bindParam(':title_name',$title_name, PDO::PARAM_STR);
        $db->bindParam(':description',$description, PDO::PARAM_STR);
        $db->bindParam(':user_id',$user_id, PDO::PARAM_STR);
        $db->bindParam(':parent_id',$parent_id, PDO::PARAM_STR);
        $db->bindParam(':type_id',$type_id, PDO::PARAM_STR);
        $db->bindParam(':lvl',$lvl, PDO::PARAM_STR);

        return $db->execute();
    }
    public static function getTopicById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE id = :id AND type_id = 3";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getCountTopic($id){
        $db = Forum::getForum();

        $list = array();
        $keys = array();
        $keys[] = $id;

        while($row = $db->fetch()){
            if(in_array($row['parent_id'], $keys)) {
                if($row['type_id'] == 3)
                    $list[] = $row['id'];
                $keys[] = $row['id'];
            }
        }
        return count($list);
    }
    public static function getCountTopicByUserId($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE user_id = :id AND type_id = 3";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        return count($db->fetchAll());
    }
    public static function getTopicMessages($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM topic_messages WHERE topic_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function deleteTopic($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id",$id,PDO::PARAM_STR);

        return $db->execute();
    }
    public static function editTopic($id , $title_name , $description){
        $connect = DataBase::getConnection();
        $sql = "UPDATE forum SET title_name = :title_name , description = :description WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(":id",$id,PDO::PARAM_STR);
        $db->bindParam(":title_name",$title_name,PDO::PARAM_STR);
        $db->bindParam(":description",$description,PDO::PARAM_STR);

        return $db->execute();
    }
}