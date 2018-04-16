<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 10:08
 */

class UserController
{
    public function actionLogout()
    {
        User::destroyUserSession();
        header("Location: /download");
    }

    public function actionLogin()
    {
        $params = array();
        if (isset($_POST['submit'])) {
            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }
            $errors = false;
            $user = User::checkUser($params);
            if ($user == false) {
                $errors = "Неправильно введены данные, повторите ещё раз";
            } else {
                User::createUserSession($user);
                header("Location: /download");
            }
        }
        require_once(ROOT . '/views/auth/login.php');
        return true;
    }

    public function actionSign()
    {
        $params = array();
        $params['name'] = '';
        $params['email'] = '';
        $params['password'] = '';
        if (isset($_POST['submit'])) {
            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }
            $errors = false;
            if (!User::validateName($params['name'])) {
                $errors[] = 'Логин не должен быть пустым и его длина должна быть не меньше 6 символов';
            }
            if (!User::validatePassword($params['password'])) {
                $errors[] = 'Пароль должен быть > или = 7 символов, а также иметь хотябы 1-у заглавную букву';
            }
            if (User::validateEmail($params['email'])) {
                $errors[] = 'Такой E-mail уже зарегистрирован';
            }
            if (!User::validateConfirmPassword($params['password'], $params['confirm_password'])) {
                $errors[] = 'Пароли не совпадают';
            }
            if (!$errors) {
                $id = User::createUser($params);
                $user = User::checkUser($params);

                if ($id) {
                    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                        move_uploaded_file($_FILES["userfile"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/user/$id.jpg");
                    }
                }

                User::createUserSession($user);
                $result = true;
            }
        }

        require_once(ROOT . '/views/auth/sign.php');
        return true;
    }

    public function actionEdit($id)
    {
        if(!User::getUserById($_SESSION['user_id']))
            die('У вас нету прав к этой странице');
        $user = User::getUserById($id);
        $name = '';
        $email = '';
        $typefile = array('jpg', 'jpeg', 'png');
        $result = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            $errors = false;
            if (!User::validateName($name)) {
                $errors[] = 'Логин не должен быть пустым и его длина должна быть не меньше 6 символов';
            }
            if($email != $user['email']){
                if (User::validateEmail($email)) {
                    $errors[] = 'Такой E-mail уже зарегистрирован';
                }
            }
            if ($new_password) {
                if (User::validatePassword($new_password)) {
                    if (User::checkPassword($id, $old_password)) {
                        User::updateUserPassword($id, $new_password);
                    }
                    else
                        $errors[] = 'Неправильный пароль ,проверти правильность введеного пароля';
                }
                else
                    $errors[] = 'Пароль должен быть > или = 7 символов, а также иметь хотябы 1-у заглавную букву';
            }

            if (!$errors) {
                User::updateUser($id, $name, $email);
                if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                    $filesize = $_FILES['userfile']['size'];
                    if($filesize < 3145728){
                        foreach ($typefile as $value) {
                            if ($value == substr($_FILES['userfile']['name'], -3)) {
                                move_uploaded_file($_FILES["userfile"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/user/$id.$value");
                                $result = true;
                            }
                        }
                    }else
                        $errors[] = 'Размер файла не должен привышать больше 3 МБ';
                }
                if (!$result) {
                    $errors[] = 'Неправильный тип файла';
                }

            }
        }

        require_once(ROOT . '/views/auth/edit.php');
        return true;
    }
    public function actionDelete(){
        Admin::isAdmin();
        if(isset($_POST['submit'])){
            $name = $_POST['user_name'];
            $errors = false;
            if(User::getUserByName($name)){
                User::deleteUser($name);
                $errors[] = 'Пользователь удалён';
            }else
                $errors[] = 'Такого пользователя несуществует';
        }
        require_once(ROOT . '/views/admin/delete_user.php');
        return true;
    }
}