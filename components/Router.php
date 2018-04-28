<?php
/**
 * Роутер отвечает за :
 * Анализ запроса
 * Подключения контроллера
 * Передача управления контроллеру
 */

class Router
{
    private $routes;
    // Вытаскиваем массив из файла routes.php в переменную $routes
    public function __construct()
    {
        $routesPath = parse_ini_file(ROOT."/config/routes.ini",true);
        $this->routes = $routesPath;
    }

    // Возвращает URI из адресной строки
    private function getURL(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'] , '/');
        }
        return false;
    }
    public function run(){
        $uri = $this->getURL();

        // Идём циклом по массиву с маршрутами
        foreach($this->routes as $key => $value){
            foreach($value as $uriPath => $path) {
                // Сравниваем URI с роутами по ключу
                if (preg_match("~$path~", $uri)) {
                    // Ищем и заменяем маршрут тем ,что пришло из URI с помощью регулярки
                    $internalRoute = preg_replace("~$path~", "$1/$2" , $uri);
                    $segments = explode('/', $internalRoute);

                    $controllerName = ucfirst($key) . 'Controller';
                    //echo $controllerName.'<br>';

                    $actionName = 'action' . ucfirst($uriPath);
                    //echo $actionName.'<br>';

                    $parameters = $segments;
                    //var_dump($segments);
                    // Подключаем нужный файл (контроллер)
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                    if (file_exists($controllerFile))
                        include_once($controllerFile);

                    // Вызываем необходимый экшен класса и передаём в него дополнительные параметры
                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    if ($result != null)
                        break;
                }
            }
        }
        if(!$uri){
            include_once(ROOT.'/controllers/MatrixController.php');
            $controllerObject = new MatrixController;
            $controllerObject->actionWelcome();
        }
    }
}