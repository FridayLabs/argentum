<?php

$factory->define(Argentum\Model\User::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->email,
        'api_token' => str_random(32)
    ];
});

$factory->define(Argentum\Model\Layout::class, function (Faker\Generator $faker) {
    return [
        'structure' => json_encode([
            ['type' => 'widget-header', 'children' => [
                ['type' => 'widget-container', 'config' => ['isFullWidth' => true], 'children' => [
                    ['type' => 'widget-row', 'children' => [
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph,
                            ]],
                        ]],
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph,
                            ]],
                        ]],
                    ]],
                ]],
            ]],
            ['type' => 'widget-main', 'children' => [
                ['type' => 'system-content'],
            ]],
            ['type' => 'widget-footer', 'children' => [
                ['type' => 'widget-container', 'config' => ['isFullWidth' => false], 'children' => [
                    ['type' => 'widget-row', 'children' => [
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph,
                            ]],
                        ]],
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph,
                            ]],
                        ]],
                    ]],
                ]],
            ]],
        ]),
    ];
});

$factory->define(Argentum\Model\Page::class, function (Faker\Generator $faker) {
    $name = $faker->sentence(3);

    return [
        'alias'     => str_slug($name),
        'title'     => $name,
        'structure' => json_encode([
            ['type' => 'widget-container', 'config' => ['isFullWidth' => true], 'children' => [
                ['type' => 'widget-row', 'children' => [
                    ['type' => 'widget-column', 'config' => ['size' => ['xs' => 4]], 'children' => [
                        ['type' => 'widget-paragraph', 'config' => [
                            'content' => $faker->paragraph,
                        ]],
                    ]],
                    ['type' => 'widget-column', 'config' => ['size' => ['xs' => 8]], 'children' => [
                        ['type' => 'widget-paragraph', 'config' => [
                            'content' => $faker->paragraph,
                        ]],
                    ]],
                ]],
            ]],
        ]),
    ];
});

$factory->define(Argentum\Model\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt($faker->password)
    ];
});

$factory->define(Argentum\Model\Project::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'domain' => str_random(5) . '.Argentum.dev',
        'description' => mt_rand(0, 1) ? $faker->paragraph : ''
    ];
});
