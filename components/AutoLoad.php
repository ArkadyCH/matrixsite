<?php
/**
 * Created by PhpStorm.
 * User: Arkady
 * Date: 02.04.2018
 * Time: 16:02
 */

class AutoLoad
{
    public static function autoloader(){
        spl_autoload_register(function ($class_name) {
            $array_path = array(
                '/models/',
                '/components/'
            );

            foreach($array_path as $path){
                $path = ROOT.$path.$class_name.'.php';
                if(is_file($path)){
                    include_once $path;
                }
            }
        });

    }
}
AutoLoad::autoloader();