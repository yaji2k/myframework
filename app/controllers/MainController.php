<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController {

    public function indexAction() {
        $db = new Main();
        $result = $db->query(2, 'id');
        foreach ($result as $array) {
            foreach ($array as $key => $value) {
                echo "<br> $key: $value";
            }
            echo '<br>';
        }
    }

}
