<?php

namespace Modules\LogSuratMasuk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class LogSuratMasuk extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'log_surat_masuk';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = ['action', 'description'];

    protected static function newFactory()
    {
        return LogSuratMasukFactory::new();
    }
}
