<?php

use Illuminate\Support\Facades\Route;
use Modules\LogSuratMasuk\Controllers\LogSuratMasukController;

Route::middleware('web')->group(function () {
    Route::group(
        [
            'prefix' => config('modules.log-surat-masuk.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.log-surat-masuk.routes.middleware'),
    ],
    function () {
        // Menggunakan except() untuk mendaftarkan semua rute kecuali yang tidak kita perlukan.
        // Ini akan mendaftarkan rute index, create, dan store, sehingga error tidak muncul.
        Route::resource('log-surat-masuk', LogSuratMasukController::class)->except(['show', 'edit', 'update', 'destroy']);
    }
    );
});
