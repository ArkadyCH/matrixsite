<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 01.04.2018
 * Time: 18:02
 */

class MatrixController
{
    public function actionDownload(){
        require_once(ROOT . '/views/download/download.php');
        return true;
    }
    public function actionCabinet(){
        $user = User::getUserById($_SESSION['user_id']);
        $permission = User::getUserPermission($user['id']);
        require_once(ROOT . '/views/matrix/cabinet.php');
        return true;
    }
}