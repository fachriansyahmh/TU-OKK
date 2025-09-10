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

    public function updated(SuratMasuk $suratMasuk)
    {
        // Logika untuk Log Surat Masuk (tetap ada untuk semua pembaruan)
        LogSuratMasuk::create([
            'user_id' => Auth::id(),
            'surat_masuk_id' => $suratMasuk->id,
            'action' => 'DIPERBARUI',
            'description' => "Surat masuk dengan nomor naskah \"{$suratMasuk->nomor_naskah}\" telah diperbarui.",
        ]);

        // Logika BARU untuk Log Disposisi
        // Cek jika ada perubahan pada salah satu kolom disposisi
        if ($suratMasuk->isDirty('disposisi_kepada') || $suratMasuk->isDirty('disposisi_id') || $suratMasuk->isDirty('isi_disposisi')) {

            // Cek kondisi SEBELUM update. Jika semua kolom disposisi sebelumnya kosong,
            // maka ini adalah disposisi yang pertama kali dibuat.
            $isFirstDisposisi = empty($suratMasuk->getOriginal('disposisi_kepada')) &&
                                empty($suratMasuk->getOriginal('disposisi_id')) &&
                                empty($suratMasuk->getOriginal('isi_disposisi'));

            if ($isFirstDisposisi) {
                $action = 'DISPOSISI DIBUAT';
                $deskripsi = "Disposisi baru untuk surat \"{$suratMasuk->nomor_naskah}\" telah dibuat.";
            } else {
                $action = 'DISPOSISI DIPERBARUI';
                $deskripsi = "Disposisi untuk surat \"{$suratMasuk->nomor_naskah}\" telah diperbarui.";
            }

            LogDisposisi::create([
                'user_id' => Auth::id(),
                'surat_masuk_id' => $suratMasuk->id,
                'action' => $action,
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
