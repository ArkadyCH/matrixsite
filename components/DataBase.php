<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 11:00
 */

class DataBase
{
    public static function getConnection(){
        $params = parse_ini_file(ROOT."/config/dbparams.ini");

        $dsn = "mysql:host={$params['host']};dbname={$params['name']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        return $db;
    }
}