<?php

use Illuminate\Support\Facades\Route;
use Modules\LogSuratMasuk\Controllers\LogSuratMasukController;

Route::group(
    [
        'prefix' => config('modules.log-surat-masuk.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.log-surat-masuk.routes.middleware'),
    ],
    function () {
        Route::resource('log-surat-masuk', LogSuratMasukController::class);
    }
);
