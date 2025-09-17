<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Sheet Id
    |--------------------------------------------------------------------------
    */
    'sheet_id' => env('GOOGLE_SHEET_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Google Drive Service Account
    |--------------------------------------------------------------------------
    */
    'service' => [
        'enable' => env('GOOGLE_SERVICE_ACCOUNT_ENABLE', true),

        // PERBAIKAN: Menggunakan storage_path() untuk mendapatkan path absolut
        'file' => storage_path(env('GOOGLE_SERVICE_ACCOUNT_JSON_PATH', 'app/google-credentials.json')),
    ],

    'config' => [
        //
    ],
];