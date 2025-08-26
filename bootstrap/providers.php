<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    Modules\Pengolah\Providers\PengolahServiceProvider::class,
    // Modules\Kategori\Providers\KategoriServiceProvider::class,
    Modules\JenisSurat\Providers\JenisSuratServiceProvider::class,
    Modules\SuratMasuk\Providers\SuratMasukServiceProvider::class,
    // Modules\DisposisiKepada\Providers\DisposisiKepadaServiceProvider::class,
    Modules\Disposisi\Providers\DisposisiServiceProvider::class,


    

];
