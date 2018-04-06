<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 03.04.2018
 * Time: 18:16
 */

class ForumController
{
    public function actionView(){
        $listSections = Forum::getSections();
        require_once(ROOT . '/views/forum/view.php');
        return true;
    }

    public function actionViewCategory($id){
        $listSections= Forum::getCategoriesById($id);
        $listCategories = Forum::getCategoriesBySectionId($id);
        $listTopic = Forum::getTopicById($id);

        require_once(ROOT . '/views/forum/category.php');
        return true;
    }
    public function actionViewTopic($id){
        $listTopic = Forum::getTopicById($id);
        require_once(ROOT . '/views/forum/topic.php');
        return true;
    }
    public function actionCreateCategory(){
        $params = array();
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            }
            if($params['parent_id'] == 0){
                $type_id = 1;
            }else{
                $type_id = 2;
            }
            if(Forum::saveCategory($params['title_name'],$params['description'],$params['parent_id'] , $user_id , $type_id)){
                header('Location: forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $list = Forum::getListSection();
        require_once(ROOT . '/views/forum/create.php');
        return true;
    }
    public function actionCreateTopic($id){
        $params = array();
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            }
            $type_id = 3;
            $parent_id = $id;
            if(Forum::saveTopic($params['title_name'],$params['description'],$parent_id , $user_id , $type_id)){
                header('Location: forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $title_name = Forum::getListSection();
        require_once(ROOT . '/views/forum/createTopic.php');
        return true;
    }
    public function actionDelete(){
        $id = '';
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
        }
        $list = Forum::getListAll();
        $result = Forum::getChildById($id);

        Forum::deleteCategoryById($id);
        if(is_array($result)){
            foreach($result as $key => $value)
            {
                foreach($value  as  $inner_key => $inner_value)
                {
                    Forum::deleteCategoryById($inner_value);
                }
            }
        }
        require_once(ROOT . '/views/forum/delete.php');
        return true;
    }

}