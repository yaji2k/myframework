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
//        debug(getType($this->query));
//        debug(getType($this->param));
//        echo phpinfo();   
        $this->checkValid($this->query);
        echo debug(self::$route);
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
                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                self::$route = $route;
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

    public function getRoutes() {
        $routes = self::$routes;
        return debug($routes);
    }

}
