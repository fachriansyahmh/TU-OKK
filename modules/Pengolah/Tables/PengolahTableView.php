<?php

namespace Modules\Pengolah\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\Pengolah\Models\Pengolah;

class PengolahTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, Pengolah>
     */
    public function source(): LengthAwarePaginator
    {
        return Pengolah::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('nama_pengolah')->sortable(),
            RestfulButton::make('modules::pengolah'),
        ];
    }
}
