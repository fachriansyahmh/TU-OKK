<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\LogSuratMasuk\Models\LogSuratMasuk;
use Modules\SuratMasuk\Models\SuratMasuk;

class SuratMasukObserver
{
    public function created(SuratMasuk $suratMasuk): void
    {
        LogSuratMasuk::create([
            'user_id' => Auth::id(),
            'surat_masuk_id' => $suratMasuk->id,
            'action' => 'DIBUAT',
            'description' => 'Surat masuk baru dengan nomor naskah "' . $suratMasuk->nomor_naskah . '" telah dibuat.',
        ]);
    }

    public function updated(SuratMasuk $suratMasuk): void
    {
        LogSuratMasuk::create([
            'user_id' => Auth::id(),
            'surat_masuk_id' => $suratMasuk->id,
            'action' => 'DIPERBARUI',
            'description' => 'Data surat masuk dengan nomor naskah "' . $suratMasuk->nomor_naskah . '" telah diperbarui.',
        ]);
    }

    // Mengubah dari "deleted" menjadi "deleting"
    public function deleting(SuratMasuk $suratMasuk): void
    {
        LogSuratMasuk::create([
            'user_id' => Auth::id(),
            'surat_masuk_id' => $suratMasuk->id,
            'action' => 'DIHAPUS',
            'description' => 'Surat masuk dengan nomor naskah "' . $suratMasuk->nomor_naskah . '" telah dihapus.',
        ]);
    }
}
