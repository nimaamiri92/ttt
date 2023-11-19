<?php

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            //TODO::first read from ENV file
            'driver'   => 'mysql',
            'host' => 'mysqldb',
            'database' => 'check24',
            'username' => 'root',
            'password' => '123123',
            'charset' => 'utf8mb4',
        ],
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => 'path/to/your/database.sqlite',
            'prefix'   => '',
        ],
        // Add more drivers as needed
    ],
];
