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
}