<?php

namespace vendor\core\base;

abstract class Controller {

    public $layout;
            
        public function view($route) {
            $view = new View($route, $this->layout);
            $view->render();
    }

}


