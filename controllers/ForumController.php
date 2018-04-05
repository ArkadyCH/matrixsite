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
        $listCategories= Forum::getCategoriesById($id);

        require_once(ROOT . '/views/forum/category.php');
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
            if(Forum::saveCategory($params['title_name'],$params['description'],$params['parent_id'] , $user_id)){
                echo 'succes';
                header('Location: /forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $title_name = Forum::getListSection();
        require_once(ROOT . '/views/forum/create.php');
        return true;
    }
}