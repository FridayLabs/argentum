<?php

return [
    'namespace' => 'Modules',
    'stubs' => [
        'enabled' => false,
        'path' => base_path() . '/vendor/nwidart/laravel-modules/src/Commands/stubs',
        'files' => [
            'start' => 'start.php',
            'routes' => 'Http/routes.php',
            'json' => 'module.json',
            'views/index' => 'Resources/views/index.blade.php',
            'views/master' => 'Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Config/config.php',
            'composer' => 'composer.json',
        ],
        'replacements' => [
            'start' => ['LOWER_NAME'],
            'routes' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
            ],
        ],
    ],
    'paths' => [
        'modules' => base_path('modules'),
        'assets' => public_path('modules'),
        'migration' => base_path('database/migrations'),
        'generator' => [
//            'assets' => 'Assets',
            'config' => 'Config',
//            'command' => 'Console',
//            'event' => 'Events',
//            'listener' => 'Events/Handlers',
//            'migration' => 'Database/Migrations',
//            'model' => 'Entities',
//            'repository' => 'Repositories',
//            'seeder' => 'Database/Seeders',
            'controller' => 'Http/Controllers',
//            'filter' => 'Http/Middleware',
//            'request' => 'Http/Requests',
            'provider' => 'Providers',
//            'lang' => 'Resources/lang',
//            'views' => 'Resources/views',
//            'test' => 'Tests',
//            'jobs' => 'Jobs',
//            'emails' => 'Emails',
//            'notifications' => 'Notifications',
        ],
    ],
    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    'composer' => [
        'vendor' => 'fridaylabs',
        'author' => [
            'name' => 'Vitaliy Krasnoperov',
            'email' => 'alistar.neron@gmail.com',
        ],
    ],
    'cache' => [
        'enabled' => false,
        'key' => 'argentum-modules',
        'lifetime' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
    ],
];
