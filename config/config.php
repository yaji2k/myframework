<?php

$config = [
    'routes' => [
        '^(?<controller>[a-z-]+)/?$' => [
            'action' => 'index',
        ],
        '^$' => [
            'controller' => 'Main',
            'action' => 'index',
        ],
        '^(?<controller>[a-z-]+)/(?<action>[a-z-]+)$' => [
        ],
    ],
    'db' => [
        "dsn" => "mysql:host=localhost;dbname=eveblog;charset=utf8",
        "user" => "test",
        "password" => "test",
        "opt" => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,],
    ],
];

return $config;
