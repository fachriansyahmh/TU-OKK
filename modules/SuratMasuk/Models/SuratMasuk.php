<?php

namespace Modules\SuratMasuk\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Modules\Disposisi\Models\Disposisi;
use Modules\JenisSurat\Models\JenisSurat;

class SuratMasuk extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'surat_masuk';

    protected $guarded = [];

    /**
     * PERBAIKAN:
     * 1. Mengubah 'pengolah.nama_pengolah' menjadi 'pengolah.name' agar sesuai dengan relasi ke tabel User.
     * 2. Mengubah 'instansi_pengirim' menjadi 'asal_pengirim' sesuai dengan nama kolom yang baru.
     */
    protected $searchableColumns = [
        'status',
        'pengolah.name',
        'sifat_naskah',
        'jenis_surat.jenis_surat',
        'nama_pengirim',
        'jabatan_pengirim',
        'asal_pengirim',
        'nomor_naskah',
        'tgl_naskah',
        'tgl_diterima',
        'ringkasan_isi_surat',
        'disposisi_kepada',
        'isi_disposisi',
        'isi_disposisi_sekjen_deputi',
        'nomor_urut',
    ];

    // Menambahkan method boot untuk logika otomatis
    protected static function boot()
    {
        parent::boot();

        // Berjalan SEBELUM data baru disimpan
        static::creating(function ($model) {
            // Cari nomor urut terbesar, lalu tambahkan 1
            $model->nomor_urut = (self::max('nomor_urut') ?? 0) + 1;
        });

        // Berjalan SEBELUM data dihapus
        static::deleting(function ($model) {
            // Ambil nomor urut dari data yang akan dihapus
            $deletedNomorUrut = $model->nomor_urut;

            // Kurangi 1 dari semua nomor urut yang lebih besar
            self::where('nomor_urut', '>', $deletedNomorUrut)->decrement('nomor_urut');
        });
    }

    public function pengolah()
    {
        // Relasi ini sekarang menunjuk ke model User
        return $this->belongsTo(User::class, 'pengolah_id');
    }

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_naskah_id');
    }

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'disposisi_id');
    }
}
