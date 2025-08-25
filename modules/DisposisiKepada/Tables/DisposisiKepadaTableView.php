<?php

namespace Modules\DisposisiKepada\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\DisposisiKepada\Models\DisposisiKepada;


class DisposisiKepadaTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, DisposisiKepada>
     */
    public function source(): LengthAwarePaginator
    {
        return DisposisiKepada::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('disposisi_kepada')->sortable(),
            RestfulButton::make('modules::disposisi-kepada'),
        ];
    }
}
