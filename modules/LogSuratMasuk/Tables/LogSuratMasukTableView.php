<?php

namespace Modules\LogSuratMasuk\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Date;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Raw;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\LogSuratMasuk\Models\LogSuratMasuk;

class LogSuratMasukTableView extends TableView
{
    // Mengatur judul tabel sebagai properti
    protected $title = 'Log Surat Masuk';

    /**
     * Meng-override method ini dan mengembalikan array kosong
     * akan menghapus tombol "+ Add" dari header tabel.
     * @return array
     */
    public function headerActions(): array
    {
        return [];
    }

    /**
     * Meng-override method ini dan mengembalikan array kosong
     * akan menghapus tombol aksi (edit/hapus) dari setiap baris.
     * @return array
     */
    public function actions(): array
    {
        return [];
    }

    /**
     * @return LengthAwarePaginator<int, LogSuratMasuk>
     */
    public function source(): LengthAwarePaginator
    {
        // Menggunakan with() untuk eager loading agar lebih efisien
        return LogSuratMasuk::with(['user', 'suratMasuk'])->autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    /**
     * @return array<int, mixed>
     */
    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Raw::make(function ($data) {
                // Menampilkan nama pengguna dari relasi
                return $data->user?->name ?? 'Pengguna Dihapus';
            }, 'Nama User')->sortable('user.name'),

            Raw::make(function ($data) {
                // Menampilkan nomor naskah dari relasi
                return $data->suratMasuk?->nomor_naskah ?? 'Surat Dihapus';
            }, 'Nomor Naskah')->sortable('suratMasuk.nomor_naskah'),

            Text::make('action', 'Aksi')->sortable(),

            Raw::make(function ($data) {
                return $data->suratMasuk?->ringkasan_isi_surat ?? 'Surat Dihapus';
            }, 'Ringkasan Isi Surat')->sortable('suratMasuk.ringkasan_isi_surat'),

            // Menambahkan kolom untuk menampilkan waktu dan tanggal aksi
            Raw::make(function ($data) {
                // Menggunakan Carbon untuk memformat tanggal ke format Indonesia
                return optional($data->created_at)->isoFormat('D MMMM YYYY, HH:mm');
            }, 'Waktu Aksi')->sortable('created_at'),
        ];
    }
}
