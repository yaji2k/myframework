<?php

define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('WWW', dirname(__DIR__) . '/public');
define('CORE', dirname(__DIR__) . '/vendor/core');

require_once LIBS . '/debug.php';

use vendor\core\Router;

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$router = new Router();
$router->run();


