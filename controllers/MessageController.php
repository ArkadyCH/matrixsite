<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 18:15
 */

class MessageController
{
    public function actionCreate($id){
        $text ='';
        $user_id = '';
        if(isset($_POST['submit'])){
            $text = $_POST['text'];
            $user_id = $_SESSION['user_id'];
            Message::saveMessage($text,$user_id,$id);
            header("Location: /profile/$id");
        }
        require_once(ROOT . '/views/messages/create.php');
        return true;
    }
    public function actionIndex($id){
        $user_id = Message::getUserIdByMessageId($_SESSION['user_id']);
        $userList = array();
        $user_name = User::getUserNameById($id);
        $messageList = Message::getPersonalMessages($id , $_SESSION['user_id']);
        foreach ($user_id as $key => $value){
            $userList[] = User::getUserById($value['from_user_id']);
        }
        require_once(ROOT . '/views/messages/index.php');
        return true;
    }
}