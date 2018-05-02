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
    public function errorHandler($errno, $errmsg, $filename, $line)
    {
        self::my_log($errno,$errmsg,$filename,$line);
        die('Страница временно не работает') ;
    }
    public function handler_error(Error $e){
        self::my_log($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine());
        echo 'Страница временно не работает';
        return true;
    }
    public function my_log($errno,$errmsg,$filename,$line){
        $log_file_name = $_SERVER['DOCUMENT_ROOT']."/logs/my_log.txt";
        $now = date("Y-m-d H:i:s");
        file_put_contents(
            $log_file_name, $now." | №: ".$errno." | Message: ".$errmsg
            ." | File: ".$filename." | Line: ".$line."\r\n", FILE_APPEND
        );
    }
}