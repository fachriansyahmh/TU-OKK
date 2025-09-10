<?php

namespace Modules\LogSuratMasuk\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Modules\SuratMasuk\Models\SuratMasuk;

class LogSuratMasuk extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'log_surat_masuk';

    protected $guarded = [];

    /**
     * PERBAIKAN:
     * Menambahkan 'suratMasuk.ringkasan_isi_surat' ke dalam array
     * agar fitur pencarian bisa mencari di kolom relasi.
     */
    protected $searchableColumns = [
        'action',
        'description',
        'user.name',
        'suratMasuk.nomor_naskah',
        'suratMasuk.ringkasan_isi_surat' // <-- Tambahkan baris ini
    ];

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendefinisikan relasi ke model SuratMasuk.
     */
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }
}
