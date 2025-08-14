<?php

namespace Modules\Pengolah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Pengolah extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'pengolah';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = ['nama_pengolah'];

    protected static function newFactory()
    {
        return PengolahFactory::new();
    }
}
