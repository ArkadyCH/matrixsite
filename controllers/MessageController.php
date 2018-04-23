<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 18:15
 */

class MessageController
{
    public function actionCreate($id)
    {
        $text = '';
        $user_id = '';
        if (isset($_POST['submit'])) {
            $text = $_POST['text'];
            $send = $_SESSION['user_id'];
            $recive = $id;
            if (User::getUserById($recive)) {
                if($dialog = Message::getDialog($send , $recive)){
                    Message::updateDialog($send , $recive , $dialog['id']);
                    $dialog_id = Message::getIdLastDialog($send , $recive);
                }

                else
                    $dialog_id = Message::saveDialog($send,$recive);
                Message::saveMessage($text, $send, $dialog_id);
                header("Location: /profile/$recive");
            }
        }
        require_once(ROOT . '/views/messages/create.php');
        return true;
    }

    public function actionIndex()
    {
        $dialogs = Message::getAllDialog($_SESSION['user_id']);

        require_once(ROOT . '/views/messages/index.php');
        return true;
    }
    public function actionDialog($id){
        $userId = $_SESSION['user_id'];
        $dialog = Message::getDialog($userId , $id);
        if($dialog['recive'] == $userId)
            Message::setStatusDialog($id ,$userId);
        $dialogs = Message::getAllDialog($userId);
        foreach ($dialogs as $key => $value){
            if(($value['send'] == $id && $value['recive'] == $userId) || ($value['send'] == $userId && $value['recive'] == $id))
                $messageList = Message::getPersonalMessages($value['id']);
        }
        if (isset($_POST['submit'])) {
            $message = $_POST['message'];
            if (User::getUserById($id)) {
                if($dialog){
                    Message::updateDialog($userId , $id , $dialog['id']);
                    $dialog_id = Message::getIdLastDialog($userId , $id);
                }
                Message::saveMessage($message, $userId, $dialog_id);
                header("Location: /dialog/$id");
            }
        }
        require_once(ROOT . '/views/messages/view.php');
        return true;
    }
}