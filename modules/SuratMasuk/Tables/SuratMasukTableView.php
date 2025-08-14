<?php

namespace Modules\SuratMasuk\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\Columns\Raw;
use Laravolt\Suitable\TableView;
use Modules\SuratMasuk\Models\SuratMasuk;


class SuratMasukTableView extends TableView
{
    /**
     * @return LengthAwarePaginator<int, SuratMasuk>
     */
    public function source(): LengthAwarePaginator
    {
        return SuratMasuk::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('status')->sortable(),
            Raw::make(function ($data) {
                return $data->pengolah->nama_pengolah;
            }, 'Pengolah')->sortable('pengolah.nama_pengolah'),
            Text::make('sifat_naskah')->sortable(),
            Raw::make(function ($data) {
                return $data->jenis_surat->jenis_surat;
            }, 'Jenis Naskah')->sortable('jenis_surat.jenis_surat'),
            Text::make('nama_pengirim')->sortable(),
            Text::make('jabatan_pengirim')->sortable(),
            Text::make('instansi_pengirim')->sortable(),
            Text::make('nomor_naskah')->sortable(),
            Text::make('tgl_naskah')->sortable(),
            Text::make('tgl_diterima')->sortable(),
            Text::make('ringkasan_isi_surat')->sortable(),
            Raw::make(function ($data) {
                return '<a href="' . $data->lampiran. '" target="_blank" class="ui icon button basic mini"><i class="file alternate icon"></i></a>';
}, 'Lampiran'),
            RestfulButton::make('modules::surat-masuk'),
        ];
    }
}
