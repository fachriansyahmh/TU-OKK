<?php

namespace Modules\Disposisi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Disposisi extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'disposisi';

    protected $guarded = [];

    /** @var array<string> */
    protected $searchableColumns = ['disposisi'];

    protected static function newFactory()
    {
        return DisposisiFactory::new();
    }
}
