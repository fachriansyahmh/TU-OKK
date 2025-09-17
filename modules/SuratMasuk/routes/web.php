<?php

use Illuminate\Support\Facades\Route;
use Modules\SuratMasuk\Controllers\SuratMasukController;

Route::middleware('web')->group(function () {
    Route::group(
        [
            'prefix' => config('modules.surat-masuk.routes.prefix'),
            'as' => 'modules::',
            'middleware' => config('modules.surat-masuk.routes.middleware'),
        ],
        function () {
            // Menambahkan route baru untuk halaman disposisi
            Route::get('surat-masuk/{suratMasuk}/disposisi', [SuratMasukController::class, 'disposisi'])->name('surat-masuk.disposisi');

            // Route resource untuk CRUD yang sudah ada
            Route::resource('surat-masuk', SuratMasukController::class);
        }
    );
});