<?php

namespace Modules\JenisSurat\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\JenisSurat\Models\JenisSurat;


class JenisSuratTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, JenisSurat>
     */
    public function source(): LengthAwarePaginator
    {
        return JenisSurat::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('jenis_surat', 'Jenis Naskah')->sortable(),
            RestfulButton::make('modules::jenis-surat'),
        ];
    }
}
