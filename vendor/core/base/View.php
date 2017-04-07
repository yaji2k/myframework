<?php

namespace vendor\core\base;

class View {

    public $layout;
    public $content;
    public $route =[];

    public function __construct($route, $layout = null) {
        $this->route = $route;
        if (false === $layout) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: 'default';
        }
    }


    public function render() {
        
        $file = APP . "/views/{$this->route['controller']}/{$this->route['action']}.php";
        if (is_file($file)) {
            ob_start();
            require $file;
            $content = ob_get_clean();
        }
        
        if (false !== $this->layout) {
            $layout= APP . "/views/layout/{$this->layout}/index.php";
            if (is_file($layout)) {
                require $layout;
            } else {
                echo 'шаблон не найден';
            }
        }
    }
}
