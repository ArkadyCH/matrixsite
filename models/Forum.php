<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 05.04.2018
 * Time: 18:58
 */

class Forum
{
    public static function getForum(){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum";

        $db = $connect->query($sql);
        return $db;
    }
    public static function getSections(){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE parent_id = 0";

        $db = $connect->query($sql);

        $list = array();
        $i=0;
        while($row = $db->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['title_name'] = $row['title_name'];
            $i++;
        }

        return $list;
    }
    public static function getElementById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        $list = array();
        $i=0;
        while($row = $db->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['title_name'] = $row['title_name'];
            $list[$i]['description'] = $row['description'];
            $list[$i]['type_id'] = $row['type_id'];
            $list[$i]['parent_id'] = $row['parent_id'];
            $list[$i]['lvl'] = $row['lvl'];
            $i++;
        }

        return $list;
    }
    public static function getListSection(){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE type_id != 3";

        $db = $connect->query($sql);

        $list = array();
        $i=0;
        while($row = $db->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['title_name'] = $row['title_name'];
            $i++;
        }

        return $list;
    }
    public static function getListAll(){
        $db = Forum::getForum();

        $list = array();
        $i=0;
        while($row = $db->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['title_name'] = $row['title_name'];
            $list[$i]['parent_id'] = $row['parent_id'];
            $i++;
        }

        return $list;
    }
    public static function getChildById($id){
        $db = Forum::getForum();

        $list[] = $id;
        $keys = array();
        $keys[] = $id;

        while($row = $db->fetch()){
            if(in_array($row['parent_id'], $keys)) {
                $list[] = $row['id'];
                $keys[] = $row['id'];
            }
        }
        return $list;
    }
    public static function getRoots(){
        $connect = DataBase::getConnection();

        $sql = "SELECT id FROM forum WHERE parent_id = 0";

        $db = $connect->query($sql);

        return $db->fetchAll();
    }
    public static function getCountAllMessages($id){
        $db = Forum::getForum();

        $list = array();
        $keys = array();
        $keys[] = $id;
        $count = 0;

        while($row = $db->fetch()){
            if(in_array($row['parent_id'], $keys)) {
                if($row['type_id'] == 3)
                    $list[] = $row['id'];
                $keys[] = $row['id'];
            }
        }
        foreach ($list as $item) {
            $count += self::getCountMessages($item);
        }

        return $count;
    }
    public static function getCountMessages($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM topic_messages WHERE topic_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        return $db->rowCount();
    }
    public static function getRootLvl($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT lvl FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return $result['lvl'];
        return false;
    }
    public static function getTree(){
        $roots = Forum::getRoots();
        $tree = array();
        $list = array();
        foreach($roots as $key => $value){
            $tree[] = Forum::getChildById($value['id']);
        }
        foreach($tree as $key => $value){
            foreach($value as $inner_key => $inner_value){
                $list[] = Forum::getElementById($inner_value);
            }
        }
        return $list;
    }
    public static function updateElemebt($id , $title_name , $description , $parent_id , $lvl){
        $connect = DataBase::getConnection();
        $sql = "UPDATE forum SET title_name = :title_name, description = :description , parent_id = :parent_id , lvl = :lvl WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->bindParam(':title_name' , $title_name , PDO::PARAM_STR);
        $db->bindParam(':description' , $description , PDO::PARAM_STR);
        $db->bindParam(':parent_id' , $parent_id , PDO::PARAM_STR);
        $db->bindParam(':lvl' , $lvl , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return true;
        return false;
    }
    public static function setMessage($message , $user_id , $parent_id , $topic_id){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO topic_messages (message , user_id , parent_id , topic_id)".
            " VALUES (:message,:user_id,:parent_id,:topic_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(':message' , $message , PDO::PARAM_STR);
        $db->bindParam(':user_id' , $user_id , PDO::PARAM_STR);
        $db->bindParam(':parent_id' , $parent_id , PDO::PARAM_STR);
        $db->bindParam(':topic_id' , $topic_id , PDO::PARAM_STR);

        return $db->execute();
    }
    public static function getCountUserMessages($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM topic_messages WHERE user_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        return count($db->fetchAll());
    }
    public static function deleteMessagesByTopic($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM topic_messages WHERE topic_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);

        if($db->execute())
            return true;
        return false;
    }
    public static function getType($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT type_id FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return $result['type_id'];
        return false;
    }
    public static function sectionIsTopics($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE parent_id = :id AND type_id = 3";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return true;
        return false;
    }
    public static function deleteTopicMessage($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM topic_messages WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);

        if($db->execute())
            return true;
        return false;
    }
}