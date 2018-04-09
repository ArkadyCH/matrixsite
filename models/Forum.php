<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 05.04.2018
 * Time: 18:58
 */

class Forum
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
    public static function deleteCategoryById($id){
        $connect = DataBase::getConnection();
        $sql = "DELETE FROM forum WHERE id = :id";

        $db = $connect->prepare($sql);
        $db->bindParam(':id' , $id , PDO::PARAM_STR);

        if($result = $db->execute())
            return $result;
        return false;
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
}