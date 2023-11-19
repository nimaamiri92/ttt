<?php

return [
    'providers' => [
        \App\Providers\DatabaseProvider::class,
        \App\Providers\ResponseProvider::class,
    ],
    'middlewares' => [
        'auth' => \App\Middleware\AuthenticateMiddleware::class,
    ]
];
