<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\SuratMasuk\Models\SuratMasuk;

class Home extends Controller
{
    public function __invoke(): View
    {
        $totalSurat = SuratMasuk::count();

        $belumDisposisi = SuratMasuk::where(function ($query) {
            $query->whereNull('disposisi_kepada')
                  ->whereNull('disposisi_id')
                  ->whereNull('isi_disposisi');
        })->count();

        $sudahDisposisi = $totalSurat - $belumDisposisi;

        $suratHariIni = SuratMasuk::whereDate('tgl_diterima', today())->count();

        return view('home', compact('totalSurat', 'belumDisposisi', 'sudahDisposisi', 'suratHariIni'));
    }
}