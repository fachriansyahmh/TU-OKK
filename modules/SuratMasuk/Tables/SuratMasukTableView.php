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
                return $data->pengolah?->nama_pengolah;
            }, 'Pengolah')->sortable('pengolah.nama_pengolah'),
            Text::make('sifat_naskah')->sortable(),
            Raw::make(function ($data) {
                return $data->jenis_surat?->jenis_surat;
            }, 'Jenis Naskah')->sortable('jenis_surat.jenis_surat'),
            Text::make('disposisi_kepada', 'Disposisi Kepada')->sortable(),
            Raw::make(function ($data) {
                return $data->disposisi?->disposisi;
            }, 'Disposisi')->sortable('disposisi.disposisi'),
            Text::make('isi_disposisi', 'Isi Disposisi')->sortable(),
            Text::make('nama_pengirim')->sortable(),
            Text::make('nomor_naskah')->sortable(),
            Text::make('tgl_naskah')->sortable(),
            Text::make('tgl_diterima')->sortable(),
            Raw::make(function ($data) {
                return '<a href="' . $data->lampiran . '" target="_blank" class="ui icon button basic mini"><i class="file alternate icon"></i></a>';
            }, 'Lampiran'),
            // Tombol Disposisi di kolom terpisah
            Raw::make(function ($data) {
                $disposisiUrl = route('modules::surat-masuk.disposisi', $data->id);

                return '<a href="' . $disposisiUrl . '" class="ui yellow button mini">disposisi -></a>';
            }, 'Disposisi'),
            // Kolom Aksi untuk tombol Lihat, Ubah, dan Hapus
            RestfulButton::make('modules::surat-masuk', 'Aksi'),
        ];
    }
}
