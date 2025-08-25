<?php

use Illuminate\Support\Facades\Route;
use Modules\Disposisi\Controllers\DisposisiController;

Route::group(
    [
        'prefix' => config('modules.disposisi.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.disposisi.routes.middleware'),
    ],
    function () {
        Route::resource('disposisi', DisposisiController::class);
    }
);
