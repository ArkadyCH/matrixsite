<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 01.04.2018
 * Time: 18:02
 */

class MatrixController
{
    public function actionDownload()
    {
        $file = Matrix::getCurrentFile();
        require_once(ROOT . '/views/download/download.php');
        return true;
    }

    public function actionCabinet()
    {
        if (!User::checkUserSession())
            die('Вы не авторизированы');
        $user = User::getUserById($_SESSION['user_id']);
        $permission = User::getUserPermission($user['id']);
        require_once(ROOT . '/views/matrix/cabinet.php');
        return true;
    }

    public function actionAdmin()
    {
        Admin::isAdmin();
        require_once(ROOT . '/views/admin/panel.php');
        return true;
    }

    public function actionUploadSoft()
    {
        Admin::isAdmin();
        $typefile = array('rar', 'zip', 'exe');
        $result = false;
        $errors = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['filename'];
            if (is_uploaded_file($_FILES['soft']['tmp_name'])) {
                foreach ($typefile as $value) {
                    if ($value == substr($_FILES['soft']['name'], -3)) {
                        $id = Matrix::saveFile("$name.$value");
                        Matrix::setFileStatus($id);
                        move_uploaded_file($_FILES["soft"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/softs/$id.$value");
                        $result = true;
                    }
                }
                if (!$result) {
                    $errors[] = 'Неправильный тип файла';
                }
            }
        }
        require_once(ROOT . '/views/admin/upload.php');
        return true;
    }

    public function actionDownloadSoft($name, $type)
    {
        if(User::checkUserSession()){
            $pathToFile = $_SERVER['DOCUMENT_ROOT'] . "/upload/softs/" . $name . "." . $type;
            if (file_exists($pathToFile)) {
                // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
                // если этого не сделать файл будет читаться в память полностью!
                if (ob_get_level()) {
                    ob_end_clean();
                }
                // заставляем браузер показать окно сохранения файла
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($pathToFile));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($pathToFile));
                // читаем файл и отправляем его пользователю
                if (readfile($pathToFile)) {
                    $user_id = $_SESSION['user_id'];
                    $file = Matrix::getCurrentFile();
                    $file_id = $file['id'];
                    if ($count = Matrix::checFileStats($user_id, $file_id)) {
                        $count ++;
                        Matrix::updateFileStats($file_id, $user_id , $count);
                    } else
                        Matrix::setFileStats($user_id, 1 , $file_id);
                }
                exit;
            }
        }
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
    public function actionDeleteSoft(){
        $list = Matrix::getListFiles();
        $type = '';
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            foreach ($list as $key => $value){
                if($value['id'] == $id)
                    $type = substr($value['filename'] , -4);
            }
            Matrix::deleteFile($id);
            unlink($_SERVER['DOCUMENT_ROOT'].'/upload/softs/'.$id.$type);
            header('Location: /admin');
        }
        require_once(ROOT . '/views/admin/delete_soft.php');
        return true;
    }
    public function actionEditSoft(){
        $list = Matrix::getListFiles();
        $status = '';
        $errors = '';
        $current_id ='';
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            foreach ($list as $key => $value){
                if($value['id'] == $id)
                    $status = $value['status'];
            }
            foreach ($list as $key => $value){
                if($value['status'] == 'current')
                    $current_id = $value['id'];
            }
            if($status != 'current'){
                Matrix::setOld($current_id);
                Matrix::setCurrent($id);
                header('Location: /admin');
            } else
                $errors = 'Вы выбрали файл, который и так является текущим';
        }
        require_once(ROOT . '/views/admin/edit_soft.php');
        return true;
    }
}