<?php
    // Settings
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    session_start();
    // Подключение файлов
    define('ROOT',dirname(__FILE__));
    require_once (ROOT.'/components/AutoLoad.php');

    // Вызов роутера
    $router = new Router();
    $router->run();