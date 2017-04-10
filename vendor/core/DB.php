<?php

namespace vendor\core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author yaji
 */
class DB {
    public $pdo;
    private static $connect;

    private function __construct() {
        require ROOT . '/config/config.php';
        $conf = $config['db'];

        try {
            $this->pdo =new \PDO($conf['dsn'], $conf['user'], $conf['password'], $conf['opt']);
        } catch (\PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public static function connectDb() {
        if (null === self::$connect) {
            self::$connect = new self;
        }
        return self::$connect;
    }
    
    public function query($sql, $param = []) {
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute($param)) {
            return $stmt->fetchAll();
        }
    }
    
    public function execute($sql, $param = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($param);
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}
