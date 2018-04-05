<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 05.04.2018
 * Time: 18:58
 */

class Forum
{
    public static function saveCategory($title_name , $description , $parent_id , $user_id){
        $connect = DataBase::getConnection();
        $sql = "INSERT INTO forum (title_name , description , user_id , parent_id)".
        " VALUES (:title_name,:description,:user_id,:parent_id)";

        $db = $connect->prepare($sql);
        $db->bindParam(':title_name',$title_name, PDO::PARAM_STR);
        $db->bindParam(':description',$description, PDO::PARAM_STR);
        $db->bindParam(':user_id',$user_id, PDO::PARAM_STR);
        $db->bindParam(':parent_id',$parent_id, PDO::PARAM_STR);

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
        $sql = "SELECT title_name,id FROM forum";

        $db = $connect->prepare($sql);
        $db->execute();

        $result = $db->fetchAll();

        return $result;
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
}