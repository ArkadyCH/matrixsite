<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 01.04.2018
 * Time: 18:02
 */

class MatrixController
{
    public function actionCabinet()
    {
        if (!User::checkUserSession())
            die('Вы не авторизированы');
        $user = User::getUserById($_SESSION['user_id']);
        $permission = User::getUserPermission($user['id']);
        $messages = Forum::getCountUserMessages($user['id']);
        $topics = Forum::getCountTopicByUserId($user['id']);
        require_once(ROOT . '/views/matrix/cabinet.php');
        return true;
    }

    public function actionAdmin()
    {
        Admin::isAdmin();
        require_once(ROOT . '/views/admin/panel.php');
        return true;
    }


    public function actionInfographic(){
        $files = Matrix::getFileStats(1);
        foreach ($files as $key => $value) {
            $users[] = User::getUserNameById($value['user_id'])." ".$value['data'];
            $count[] = $value['count'];
        }
        $names = json_encode($users);
        $counts = json_encode($count);
        require_once(ROOT . '/views/matrix/infographic.php');
        return true;
    }
}