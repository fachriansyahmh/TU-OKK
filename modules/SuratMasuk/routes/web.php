<?php

use Illuminate\Support\Facades\Route;
use Modules\SuratMasuk\Controllers\SuratMasukController;

Route::group(
    [
        'prefix' => config('modules.surat-masuk.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.surat-masuk.routes.middleware'),
    ],
    function () {
        Route::resource('surat-masuk', SuratMasukController::class);
    }
);
