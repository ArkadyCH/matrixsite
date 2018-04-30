<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 30.04.2018
 * Time: 17:29
 */
class Handler
{
    public function register(){
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this,'handler_error']);
    }
    public function errorHandler($errno, $errstr, $file, $line)
    {
        die('Страница временно не работает') ;
    }
    public function handler_error(Error $e){
        echo 'Страница временно не работает';
        return true;
    }
}