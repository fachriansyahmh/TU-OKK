<?php

use Illuminate\Support\Facades\Route;
use Modules\LogDisposisi\Controllers\LogDisposisiController;

Route::middleware('web')->group(function () {
    Route::group(
        [
            'prefix' => config('modules.log-disposisi.routes.prefix'),
            'as' => 'modules::',
            'middleware' => config('modules.log-disposisi.routes.middleware'),
        ],
        function () {
            Route::resource('log-disposisi', LogDisposisiController::class);
        }
    );
});
