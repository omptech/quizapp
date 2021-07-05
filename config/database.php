<?php

return [

    'fetch' => PDO::FETCH_CLASS,

    'default' => 'mysql',

    'connections' => [

        'mysql' => [
            'driver' => 'mysql', 
            'host' => env('DB_HOST'),         
            'database' => env('DB_DATABASE'), 
            'username' => env('DB_USERNAME'), 
            'password' => env('DB_PASSWORD'), 
            'charset' => 'utf8', 
            'collation' => 'utf8_unicode_ci', 
            'prefix' => '', 
            'strict' => false
        ],

        'mysql2' => [
            'driver' => 'mysql', 
            'host' => env('DB_HOST_ACADEMY'), 
            'database' => env('DB_DATABASE_ACADEMY'), 
            'username' => env('DB_USERNAME_ACADEMY'), 
            'password' => env('DB_PASSWORD_ACADEMY'), 
            'charset' => 'utf8', 
            'collation' => 'utf8_unicode_ci', 
            'prefix' => '', 
            'strict' => false
        ],

        'mysql3' => [
            'driver' => 'mysql', 
            'host' => env('DB_HOST_ACADEMY'), 
            'database' => env('DB_DATABASE_ACADEMY_DATE'), 
            'username' => env('DB_USERNAME_ACADEMY'), 
            'password' => env('DB_PASSWORD_ACADEMY'), 
            'charset' => 'utf8', 
            'collation' => 'utf8_unicode_ci', 
            'prefix' => '', 
            'strict' => false
        ]
    ],

    'migrations' => 'migrations',

    'redis' => [
        'cluster' => false,
        'default' => [
            'host' => '127.0.0.1', 
            'port' => 6379, 
            'database' => 0
        ]
    ]
];