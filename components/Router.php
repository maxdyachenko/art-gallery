<?php

class Router{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }


    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);//NEED TO BE CLARIFIED
//                echo "subject = {$uri}<br>";
//                echo "patter = {$uriPattern}<br>";
//                echo "string to replace = {$path}<br>";
//                echo "result = {$internalRoute}";

                $segments = explode('/', $internalRoute);//разбивает на массив по слешу

                $controllerName = array_shift($segments) . 'Controller'; // array_shift gets first array element and delete it from array
                $controllerName = ucfirst($controllerName);// before productController, after ProductController

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;


                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);


                if ($result != null) {
                    break;
                }
            }
        }
    }

}
