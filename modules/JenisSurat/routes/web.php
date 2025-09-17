<?php

use Illuminate\Support\Facades\Route;
use Modules\JenisSurat\Controllers\JenisSuratController;

Route::middleware('web')->group(function () {
    Route::group(
        [
            'prefix' => config('modules.jenis-surat.routes.prefix'),
            'as' => 'modules::',
            'middleware' => config('modules.jenis-surat.routes.middleware'),
        ],
        function () {
            Route::resource('jenis-surat', JenisSuratController::class);
        }
    );
});
    