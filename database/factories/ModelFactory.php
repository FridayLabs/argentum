<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Layout::class, function (Faker\Generator $faker) {
    return [
        'structure' => json_encode([
            ['type' => 'widget-header', 'children' => [
                ['type' => 'widget-container', 'config' => ['isFullWidth' => true], 'children' => [
                    ['type' => 'widget-row', 'children' => [
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph
                            ]]
                        ]],
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph
                            ]]
                        ]]
                    ]]
                ]],
            ]],
            ['type' => 'widget-main', 'children' => [
                ['type' => 'system-content']
            ]],
            ['type' => 'widget-footer', 'children' => [
                ['type' => 'widget-container', 'config' => ['isFullWidth' => false], 'children' => [
                    ['type' => 'widget-row', 'children' => [
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph
                            ]]
                        ]],
                        ['type' => 'widget-column', 'config' => ['size' => ['xs' => 6]], 'children' => [
                            ['type' => 'widget-paragraph', 'config' => [
                                'content' => $faker->paragraph
                            ]]
                        ]]
                    ]]
                ]],
            ]],
        ]),
    ];
});

$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    $name = $faker->sentence(3);
    return [
        'alias' => str_slug($name),
        'title' => $name,
        'structure' => json_encode([
            ['type' => 'widget-container', 'config' => ['isFullWidth' => true], 'children' => [
                ['type' => 'widget-row', 'children' => [
                    ['type' => 'widget-column', 'config' => ['size' => ['xs' => 4]], 'children' => [
                        ['type' => 'widget-paragraph', 'config' => [
                            'content' => $faker->paragraph
                        ]]
                    ]],
                    ['type' => 'widget-column', 'config' => ['size' => ['xs' => 8]], 'children' => [
                        ['type' => 'widget-paragraph', 'config' => [
                            'content' => $faker->paragraph
                        ]]
                    ]]
                ]]
            ]],
        ]),
    ];
});
