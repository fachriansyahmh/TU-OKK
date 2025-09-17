<?php

namespace Modules\SuratMasuk\Tables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\Columns\Raw;
use Laravolt\Suitable\TableView;
use Modules\SuratMasuk\Models\SuratMasuk;

class SuratMasukTableView extends TableView
{
    public function source(): LengthAwarePaginator
    {
        // 1. Tambahkan "with" untuk Eager Loading agar query lebih efisien
        return SuratMasuk::with('pengolah')->autoSort()->autoSearch(request('search'))->paginate(request('per_page', 15));
    }

    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Raw::make(function ($data) {
                return str_pad($data->nomor_urut, 4, '0', STR_PAD_LEFT);
            }, 'Penomoran')->sortable('nomor_urut'),
            Text::make('status')->sortable(),

            // 2. Ubah cara menampilkan nama dan kunci untuk sorting
            Raw::make(function ($data) {
                return $data->pengolah?->name; // Gunakan ->name bukan ->nama_pengolah
            }, 'Pengolah')->sortable('pengolah.name'),

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
            Text::make('jabatan_pengirim', 'Jabatan Pengirim')->sortable(),
            Text::make('asal_pengirim', 'Asal Pengirim')->sortable(),
            Text::make('nomor_naskah')->sortable(),
            Text::make('tgl_naskah', 'Tanggal Naskah')->sortable(),
            Text::make('tgl_diterima', 'Tanggal Diterima')->sortable(),
            Text::make('isi_disposisi_sekjen_deputi', 'Isi Disposisi Sekjen/Deputi')->sortable(),
            Text::make('ringkasan_isi_surat', 'Ringkasan Isi Surat')->sortable(),
            Raw::make(function ($data) {
                return '<a href="' . $data->lampiran . '" target="_blank" class="ui icon button basic mini"><i class="file alternate icon"></i></a>';
            }, 'Lampiran'),
            Raw::make(function ($data) {
                $disposisiUrl = route('modules::surat-masuk.disposisi', $data->id);

                return '<a href="' . $disposisiUrl . '" class="ui yellow button mini">disposisi -></a>';
            }, 'Disposisi'),
            RestfulButton::make('modules::surat-masuk', 'Aksi'),
        ];
    }
}

