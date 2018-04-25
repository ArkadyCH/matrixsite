<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:48
 */

class Category
{
    public static function saveCategory($title_name , $description , $parent_id , $user_id , $type_id , $lvl){
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
    public static function deleteCategoryById($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);

        return $db->execute();
    }
}