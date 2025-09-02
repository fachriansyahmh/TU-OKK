<?php

namespace Modules\SuratMasuk\Models;

use App\Models\User; // 1. Ganti import Pengolah menjadi User
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    protected $searchableColumns = [
        'status',
        'pengolah.name', // 2. Ubah kolom pencarian
        'sifat_naskah',
        'jenis_surat.jenis_surat',
        'nama_pengirim',
        'jabatan_pengirim',
        'instansi_pengirim',
        'nomor_naskah',
        'tgl_naskah',
        'tgl_diterima',
        'ringkasan_isi_surat',
        'disposisi_kepada',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_urut = (self::max('nomor_urut') ?? 0) + 1;
        });

        static::deleting(function ($model) {
            $deletedNomorUrut = $model->nomor_urut;
            self::where('nomor_urut', '>', $deletedNomorUrut)->decrement('nomor_urut');
        });
    }

    // 3. Ubah relasi agar menunjuk ke model User
    public function pengolah()
    {
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
