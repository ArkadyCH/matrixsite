<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 05.04.2018
 * Time: 18:58
 */

class Forum
{
    public static function saveCategory($title_name , $description , $parent_id , $user_id , $type_id){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO forum (title_name , description , user_id , parent_id , type_id)".
        " VALUES (:title_name,:description,:user_id,:parent_id,:type_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(':title_name',$title_name, PDO::PARAM_STR);
        $db->bindParam(':description',$description, PDO::PARAM_STR);
        $db->bindParam(':user_id',$user_id, PDO::PARAM_STR);
        $db->bindParam(':parent_id',$parent_id, PDO::PARAM_STR);
        $db->bindParam(':type_id',$type_id, PDO::PARAM_STR);

        return $db->execute();
    }
    public static function saveTopic($title_name , $description , $parent_id , $user_id , $type_id){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO forum (title_name , description , user_id , parent_id , type_id)".
            " VALUES (:title_name,:description,:user_id,:parent_id,:type_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(':title_name',$title_name, PDO::PARAM_STR);
        $db->bindParam(':description',$description, PDO::PARAM_STR);
        $db->bindParam(':user_id',$user_id, PDO::PARAM_STR);
        $db->bindParam(':parent_id',$parent_id, PDO::PARAM_STR);
        $db->bindParam(':type_id',$type_id, PDO::PARAM_STR);

        return $db->execute();
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
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum";

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
    public static function getCategoriesBySectionId($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE parent_id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getCategoriesById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getTopicById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE parent_id = :id AND type_id = 3";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetchAll())
            return $result;
        return false;
    }
    public static function getRootId($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT root_id FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->fetch())
            return $result['root_id'];
        return false;
    }
    public static function getCountTopicById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum WHERE parent_id = :id AND type_id = 3";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);
        $db->execute();

        if($result = $db->rowCount())
            return $result;
        return 0;
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
    public static function getChildById($id){
        $connect = DataBase::getConnection();
        $sql = "SELECT * FROM forum";

        $db = $connect->query($sql);

        $list = array();
        $keys = array();
        $keys[] = $id;

        while($row = $db->fetch()){
            if(in_array($row['parent_id'], $keys)) {
                $list[$row['parent_id']][] = $row['id'];
                $keys[] = $row['id'];
            }
        }
        return $list;
    }
    public static function deleteCategoryById($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);

        if($result = $db->execute())
            return $result;
        return false;
    }
}