<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:54
 */

class TopicController
{
    public function actionView($id){
        $topic= Topic::getTopicById($id);
        $user = User::getUserById($topic[0]['user_id']);

        $messages = Topic::getTopicMessages($topic[0]['id']);

        if(isset($_POST['submit'])){
            $message = $_POST['message'];

            $parent_id = 0;
            $topic_id = $topic[0]['id'];

            if(Forum::setMessage($message , $_SESSION['user_id'] , $parent_id , $topic_id)){
                header("Location: /topic/$id");
            }
        }

        require_once(ROOT . '/views/topic/topic.php');
        return true;
    }
    public function actionCreate($id){
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
            if(Topic::saveTopic($params['title_name'],$params['description'],$parent_id , $user_id , $type_id,$lvl)){
                header('Location: /forum');
            }else{
                echo 'misha vse xuina';
            }
        }
        $title_name = Forum::getListSection();
        require_once(ROOT . '/views/topic/create.php');
        return true;
    }
    public function actionDelete($id){
        Topic::deleteTopic($id);
        Forum::deleteMessagesByTopic($id);
        $path = Matrix::GoBack();
        header("Location: $path");
    }
    public function actionEdit($id){
        $topic = Topic::getTopicById($id);
        if(isset($_POST['submit'])){
            $title_name = $_POST['title_name'];
            $description = $_POST['description'];
            if(Topic::editTopic($id,$title_name,$description)){
                header("Location: /topic/$id");
            }else
                echo 'fuck';

        }
        require_once(ROOT . '/views/topic/edit.php');
        return true;
    }
}