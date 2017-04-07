<?php

namespace vendor\core;

class Router {

    private $query;
    private $param;
    private static $route;
    private static $routes;

    public function __construct() {
        include_once ROOT . '/config/config.php';
        self::$routes = $config['routes'];
        $this->explode($this->query());
    }

    public function run() {
        if ($this->checkValid($this->query)) {
            $className = "app\controllers\\{$this->className()}";
            if (class_exists($className)) {
                $obj = new $className;
                $methodName = $this->methodName();
                if (method_exists($obj, $methodName)) {
                    $obj->$methodName();
                    $obj->view(self::$route);
                }
            } else {
                echo "Контроллер $className не найден";
            }
        } else {
            echo 'страница не существует';
        }
    }

    private function query() {
        return trim($_SERVER['QUERY_STRING'], '/');
    }

    private function explode($query) {
        $explode = explode("&", $query, 2);
        $this->query = $explode[0];
        $this->param = $explode[1];
    }

    private function checkValid($subject) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("~$pattern~", $subject, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                                }
                if(!$route['action']) {
                    $route['action'] = 'index';
                }
                $route['controller'] = $this->uCCase($route['controller']);
                return self::$route = $route;
            }
        }
    }

    private function uCCase($str) {
        $lower = $this->lower($str);
        return str_replace(" ", "", ucwords(str_replace("-", " ", $lower)));
    }

    private function lower($str) {
        return strtolower($str);
    }

    private function className() {
        $controller = $this->uCCase(self::$route['controller']);
        return $controller . 'Controller';
    }

    private function methodName() {
        $action = $this->lower(self::$route['action']);
        return $action . 'Action';
    }
    
    private function getObj() {
        
    }

    public function getRoutes() {
        $routes = self::$routes;
        return debug($routes);
    }

}
