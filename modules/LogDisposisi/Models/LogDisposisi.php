<?php

namespace Modules\LogDisposisi\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class LogDisposisi extends Model
{
    use AutoFilter, AutoSearch, AutoSort;

    protected $table = 'log_disposisi';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function suratMasuk()
    {
        return $this->belongsTo(\Modules\SuratMasuk\Models\SuratMasuk::class, 'surat_masuk_id');
    }
}
