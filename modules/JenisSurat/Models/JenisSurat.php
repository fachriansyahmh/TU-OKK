<?php

namespace Modules\JenisSurat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class JenisSurat extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'jenis_surat';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = ['jenis_surat'];

    protected static function newFactory()
    {
        return JenisSuratFactory::new();
    }
}
