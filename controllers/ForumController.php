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
        $topic= Forum::getTopicById($id);
        $user = User::getUserById($topic[0]['user_id']);

        $messages = Forum::getTopicMessages($topic[0]['id']);

        if(isset($_POST['submit'])){
            $message = $_POST['message'];

            $parent_id = 0;
            $topic_id = $topic[0]['id'];

            if(Forum::setMessage($message , $_SESSION['user_id'] , $parent_id , $topic_id)){
                header("Location: /topic/$id");
            }
        }

        require_once(ROOT . '/views/forum/topic.php');
        return true;
    }
    public function actionCreateCategory(){
        Admin::isAdmin();
        $params = array();
        $lvl = '';
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            }
            if($params['parent_id'] == 0){
                $type_id = 1;
                $lvl = 0;
            }else{
                $type_id = 2;
                $lvl = Forum::getRootLvl($params['parent_id'])+1;
            }
            if(Forum::saveCategory($params['title_name'],$params['description'],$params['parent_id'] , $user_id , $type_id ,$lvl)){
                header('Location: /forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $list = Forum::getTree();
        require_once(ROOT . '/views/admin/create_category.php');
        return true;
    }
    public function actionCreateTopic($id){
        Admin::isAdmin();
        $params = array();
        $lvl = '';
        if(isset($_POST['submit'])){
            foreach($_POST as $key=>$value){
                $params[$key] = $value;
            }

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            }
            $type_id = 3;
            $parent_id = $id;
            $lvl = $lvl = Forum::getRootLvl($parent_id)+1;
            if(Forum::saveTopic($params['title_name'],$params['description'],$parent_id , $user_id , $type_id,$lvl)){
                header('Location: /forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $title_name = Forum::getListSection();
        require_once(ROOT . '/views/forum/create_topic.php');
        return true;
    }
    public function actionDelete(){
        Admin::isAdmin();
        $id = '';
        $list = Forum::getTree();
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            $result = Forum::getChildById($id);
            foreach($result as $key => $value){
                if(Forum::getType($value) == 3)
                    Forum::deleteMessagesByTopic($value);
                Forum::deleteCategoryById($value);
            }
        }
        require_once(ROOT . '/views/admin/delete_category.php');
        return true;
    }

    public function actionEdit(){
        Admin::isAdmin();
        $list = Forum::getTree();

        $title_name = '';
        $description = '';
        $parent_id = '';
        $lvl = '';
        $id = '';
        $result = false;
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $elements = Forum::getElementById($id);
            $result = true;
        }

        if(isset($_POST['submit_edit'])){
            $title_name = $_POST['title_name'];
            $description = $_POST['description'];
            $parent_id = $_POST['parent_id'];
            $id = $_POST['id'];
            $elements = Forum::getElementById($id);

            if($parent_id != $elements[0]['parent_id'])
                $lvl = Forum::getRootLvl($parent_id)+1;
            else
                $lvl = $elements[0]['lvl'];

            if(Forum::updateElemebt($id , $title_name,$description,$parent_id , $lvl))
                $result = false;
        }
        require_once(ROOT . '/views/admin/edit_category.php');
        return true;
    }
}