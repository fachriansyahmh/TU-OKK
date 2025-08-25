<?php

namespace Modules\SuratMasuk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Modules\Disposisi\Models\Disposisi;
use Modules\JenisSurat\Models\JenisSurat;
use Modules\Pengolah\Models\Pengolah;

class SuratMasuk extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'surat_masuk';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = [
        'status',
        'pengolah.nama_pengolah',
        'sifat_naskah',
        'jenis_surat.jenis_surat',
        'nama_pengirim',
        'jabatan_pengirim',
        'instansi_pengirim',
        'nomor_naskah',
        'tgl_naskah',
        'tgl_diterima',
        'ringkasan_isi_surat',
        'disposisi_kepada', // Menambahkan kolom ini agar bisa dicari
    ];

    protected static function newFactory()
    {
        // return SuratMasukFactory::new();
    }

    public function pengolah()
    {
        return $this->belongsTo(Pengolah::class, 'pengolah_id');
    }
    
    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_naskah_id');
    }

    // Relasi disposisi_kepada() dihapus karena kolomnya sekarang adalah string biasa.

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'disposisi_id');
    }
}
