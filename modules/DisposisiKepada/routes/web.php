<?php

use Illuminate\Support\Facades\Route;
use Modules\DisposisiKepada\Controllers\DisposisiKepadaController;

Route::group(
    [
        'prefix' => config('modules.disposisi-kepada.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.disposisi-kepada.routes.middleware'),
    ],
    function () {
        Route::resource('disposisi-kepada', DisposisiKepadaController::class);
    }
);
