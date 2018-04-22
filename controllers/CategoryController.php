<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:37
 */

class CategoryController
{
    public function actionView($id){
        $isLogged = User::checkUserSession();
        $isTopics =  Forum::sectionIsTopics($id);
        $listSections= Category::getCategoriesById($id);
        $listCategories = Category::getCategoriesBySectionId($id);
        $listTopic = Topic::getTopicById($id);

        require_once(ROOT . '/views/category/view.php');
        return true;
    }
    public function actionCreate(){
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
            if(Category::saveCategory($params['title_name'],$params['description'],$params['parent_id'] , $user_id , $type_id ,$lvl)){
                header('Location: /forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $list = Forum::getTree();
        require_once(ROOT . '/views/category/create.php');
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
                if(Category::deleteCategoryById($value))
                    header('Location: /admin');
            }
        }
        require_once(ROOT . '/views/category/delete.php');
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
        require_once(ROOT . '/views/category/edit.php');
        return true;
    }
}