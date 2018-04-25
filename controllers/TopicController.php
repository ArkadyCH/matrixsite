<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:54
 */

class TopicController
{
    public function actionView($id)
    {
        $topic = Topic::getTopicById($id);
        $user = User::getUserById($topic[0]['user_id']);

        $messages = Topic::getTopicMessages($topic[0]['id']);
        if (isset($_POST['submit'])) {
            $message = $_POST['message'];

            $parent_id = 0;
            $topic_id = $topic[0]['id'];

            if (Forum::setMessage($message, $_SESSION['user_id'], $parent_id, $topic_id)) {
                header("Location: /topic/$id");
            }
        }

        require_once(ROOT . '/views/topic/topic.php');
        return true;
    }

    public function actionCreate($id)
    {
        if (!User::checkUserSession())
            die('Сначало авторизируйтесь');
        $lvl = '';
        $title_name = '';
        $description = '';
        if (isset($_POST['submit'])) {
            $title_name = $_POST['title_name'];
            $description = $_POST['edit'];

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            }
            $type_id = 3;
            $parent_id = $id;
            $lvl = Forum::getRootLvl($parent_id) + 1;
            if (Topic::saveTopic($title_name, $description, $parent_id, $user_id, $type_id, $lvl)) {
                header('Location: /forum');
            } else {
                echo 'ERROR topic dont save';
            }
        }
        require_once(ROOT . '/views/topic/create.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (!Admin::isAdmin())
            die('У вас нет прав находить на данной странице');
        Topic::deleteTopic($id);
        Forum::deleteMessagesByTopic($id);
        $path = Matrix::GoBack();
        header("Location: $path");
    }

    public function actionEdit($id)
    {
        if (Admin::isAdmin() || User::getUserByTopicId($id) == $_SESSION['user_id']) {
            $topic = Topic::getTopicById($id);
            if (isset($_POST['submit'])) {
                $title_name = $_POST['title_name'];
                $description = $_POST['edit'];
                if (Topic::editTopic($id, $title_name, $description)) {
                    header("Location: /topic/$id");
                } else
                    echo 'ERROR topic dont edit';

            }
        } else
            die('dada');
        require_once(ROOT . '/views/topic/edit.php');
        return true;
    }
    public function actionDeleteMessage($topic_id,$id){
        if (Admin::isAdmin() || $_SESSION['user_id'] == User::getUserIdByMessage($id)){
            Forum::deleteTopicMessage($id);
            header("Location: /topic/$topic_id");
        }else
            die('У вас нет прав выполнять эту операцию');
    }
}