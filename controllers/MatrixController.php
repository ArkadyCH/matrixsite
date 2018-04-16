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
                        move_uploaded_file($_FILES["soft"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/softs/$name.$value");
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
    public function actionDownloadSoft($name , $type){
        $pathToFile = $_SERVER['DOCUMENT_ROOT']."/upload/softs/".$name.".".$type;
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
            if ($fd = fopen($pathToFile, 'rb')) {
                while (!feof($fd)) {
                    print fread($fd, 1024);
                }
                fclose($fd);
            }
            exit;
        }
    }
}