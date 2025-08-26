<?php

namespace Modules\LogSuratMasuk\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\LogSuratMasuk\Models\LogSuratMasuk;


class LogSuratMasukTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, LogSuratMasuk>
     */
    public function source(): LengthAwarePaginator
    {
        return LogSuratMasuk::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('user_id')->sortable(),
            Text::make('surat_masuk_id')->sortable(),
            Text::make('action')->sortable(),
            Text::make('description')->sortable(),
            RestfulButton::make('modules::log-surat-masuk'),
        ];
    }
}
