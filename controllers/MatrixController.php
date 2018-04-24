<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 01.04.2018
 * Time: 18:02
 */

class MatrixController
{
    public function actionAdmin()
    {
        if(!Admin::isAdmin())
            die('У вас нет прав находить на данной странице');
        require_once(ROOT . '/views/admin/panel.php');
        return true;
    }

    public function actionInfographic(){
        $files = Soft::getFileStats(1);
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