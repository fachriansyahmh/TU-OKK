<?php

namespace Modules\Disposisi\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\Disposisi\Models\Disposisi;


class DisposisiTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, Disposisi>
     */
    public function source(): LengthAwarePaginator
    {
        return Disposisi::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('disposisi')->sortable(),
            RestfulButton::make('modules::disposisi'),
        ];
    }
}
