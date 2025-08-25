<?php

namespace Modules\DisposisiKepada\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class DisposisiKepada extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'disposisi_kepada';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = ['disposisi_kepada'];

    protected static function newFactory()
    {
        return DisposisiKepadaFactory::new();
    }
}
