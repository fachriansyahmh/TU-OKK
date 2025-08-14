<?php

use Illuminate\Support\Facades\Route;
use Modules\Pengolah\Controllers\PengolahController;

Route::group(
    [
        'prefix' => config('modules.pengolah.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.pengolah.routes.middleware'),
    ],
    function () {
        Route::resource('pengolah', PengolahController::class);
    }
);
