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
];

return $config;
