<?php
    // Settings
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    // Подключение файлов
    define('ROOT',dirname(__FILE__));
    require_once (ROOT.'/components/Router.php');
    // Вызов роутера
    $router = new Router();
    $router->run();
