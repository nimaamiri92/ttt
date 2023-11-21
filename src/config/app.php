<?php

return [
    'providers' => [
        \App\Providers\DatabaseProvider::class,
    ],
    'middlewares' => [
        'auth' => \App\Middleware\AuthenticateMiddleware::class,
    ]
];
