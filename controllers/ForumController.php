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
}