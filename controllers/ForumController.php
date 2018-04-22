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
    public function actionCreateTopic($id){
        if(!User::checkUserSession())
            die('Сначало авторизируйтесь');
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
}