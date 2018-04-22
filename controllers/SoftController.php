<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 22.04.2018
 * Time: 11:25
 */

class SoftController
{
    public function actionIndex()
    {
        $file = Soft::getCurrentFile();
        require_once(ROOT . '/views/download/download.php');
        return true;
    }
    public function actionDelete(){
        $list = Soft::getListFiles();
        $type = '';
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            foreach ($list as $key => $value){
                if($value['id'] == $id)
                    $type = substr($value['filename'] , -4);
            }
            Soft::deleteFile($id);
            unlink($_SERVER['DOCUMENT_ROOT'].'/upload/softs/'.$id.$type);
            header('Location: /admin');
        }
        require_once(ROOT . '/views/soft/delete.php');
        return true;
    }
    public function actionEdit(){
        $list = Soft::getListFiles();
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
                Soft::setOld($current_id);
                Soft::setCurrent($id);
                header('Location: /admin');
            } else
                $errors = 'Вы выбрали файл, который и так является текущим';
        }
        require_once(ROOT . '/views/soft/edit.php');
        return true;
    }
    public function actionUpload()
    {
        if(!Admin::isAdmin())
            die('У вас нет прав находить на данной странице');
        $typefile = array('rar', 'zip', 'exe');
        $result = false;
        $errors = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['filename'];
            if (is_uploaded_file($_FILES['soft']['tmp_name'])) {
                foreach ($typefile as $value) {
                    if ($value == substr($_FILES['soft']['name'], -3)) {
                        $id = Soft::saveFile("$name.$value");
                        Soft::setFileStatus($id);
                        move_uploaded_file($_FILES["soft"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/softs/$id.$value");
                        $result = true;
                    }
                }
                if (!$result) {
                    $errors[] = 'Неправильный тип файла';
                }
            }
        }
        require_once(ROOT . '/views/soft/upload.php');
        return true;
    }

    public function actionDownload($name, $type)
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
                    $file = Soft::getCurrentFile();
                    $file_id = $file['id'];
                    if ($count = Soft::checFileStats($user_id, $file_id)) {
                        $count ++;
                        Soft::updateFileStats($file_id, $user_id , $count);
                    } else
                        Soft::setFileStats($user_id, 1 , $file_id);
                }
                exit;
            }
        }
    }
}