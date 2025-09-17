<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\LogSuratMasuk\Models\LogSuratMasuk;
use Modules\SuratMasuk\Models\SuratMasuk;
use Modules\LogDisposisi\Models\LogDisposisi;

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
        // Logika untuk Log Surat Masuk (tetap ada untuk semua pembaruan)
        LogSuratMasuk::create([
            'user_id' => Auth::id(),
            'surat_masuk_id' => $suratMasuk->id,
            'action' => 'DIPERBARUI',
            'description' => 'Data surat masuk dengan nomor naskah "' . $suratMasuk->nomor_naskah . '" telah diperbarui.',
        ]);

        // Logika untuk Log Disposisi (hanya berjalan jika ada perubahan disposisi)
        if ($suratMasuk->isDirty('disposisi_kepada') || $suratMasuk->isDirty('disposisi_id') || $suratMasuk->isDirty('isi_disposisi')) {

            $deskripsi = "Disposisi untuk surat \"{$suratMasuk->nomor_naskah}\" telah diperbarui.";

            LogDisposisi::create([
                'user_id' => Auth::id(),
                'surat_masuk_id' => $suratMasuk->id,
                'action' => 'DISPOSISI DIPERBARUI',
                'description' => $deskripsi,
            ]);
        }
    }

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
