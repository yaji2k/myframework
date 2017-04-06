<?php

$config = [
    'routes' => [
        '^$' => [
            'controller' => 'Main',
            'action' => 'index',
        ],
        '^(?<controller>[a-z-]+)/(?<action>[a-z-]+)$' => [
        ],
    ],
];

return $config;
