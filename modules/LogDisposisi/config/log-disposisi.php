<?php

return [
    'routes' => [
        'enabled' => true,
        'middleware' => ['auth'],
        'prefix' => 'modules',
    ],
    'view' => [
        'layout' => 'laravolt::layouts.app',
    ],
    'menu' => [
        'enabled' => true,
    ],
    'permission' => [],
];
