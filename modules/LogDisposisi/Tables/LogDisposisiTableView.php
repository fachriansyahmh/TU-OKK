<?php

namespace Modules\LogDisposisi\Tables;

use Illuminate\Pagination\LengthAwarePaginator;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Raw;
use Laravolt\Suitable\TableView;
use Modules\LogDisposisi\Models\LogDisposisi;

class LogDisposisiTableView extends TableView
{
    protected $title = 'Log Disposisi';

    public function headerActions(): array
    {
        return [];
    }

    public function source(): LengthAwarePaginator
    {
        // Eager load relasi suratMasuk beserta relasi disposisi di dalamnya
        return LogDisposisi::with(['user', 'suratMasuk.disposisi'])->autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    protected function columns(): array
    {
        return [
            Numbering::make('No'),
            Raw::make(fn($data) => $data->suratMasuk?->nomor_urut ? str_pad($data->suratMasuk->nomor_urut, 4, '0', STR_PAD_LEFT) : '-', 'Penomoran')->sortable('suratMasuk.nomor_urut'),
            Raw::make(fn($data) => $data->suratMasuk?->nomor_naskah ?? 'Surat Dihapus', 'Nomor Naskah')->sortable('suratMasuk.nomor_naskah'),
            Raw::make(fn($data) => $data->user?->name ?? 'Sistem', 'User')->sortable('user.name'),
            
            // PERBAIKAN: Mengubah skema warna sesuai permintaan
            Raw::make(function ($data) {
                $action = $data->action;
                $color = 'grey'; // Warna default

                switch ($action) {
                    case 'DISPOSISI DIBUAT':
                        $color = 'green'; // Dibuat menjadi hijau
                        break;
                    case 'DISPOSISI DIPERBARUI':
                        $color = 'blue'; // Diperbarui menjadi biru
                        break;
                }

                return "<div class='ui {$color} label'>{$action}</div>";
            }, 'Aksi')->sortable('action'),
            
            Raw::make(function($data) {
                if ($data->suratMasuk) {
                    $kepada = $data->suratMasuk->disposisi_kepada;
                    $arahan = $data->suratMasuk->disposisi?->disposisi;
                    $isi = $data->suratMasuk->isi_disposisi;

                    return "<strong>Kepada:</strong> {$kepada}<br><strong>Arahan:</strong> {$arahan}<br><strong>Isi:</strong> {$isi}";
                }

                return $data->description;

            }, 'Deskripsi')->sortable('suratMasuk.disposisi_kepada'),
            
            Raw::make(fn($data) => optional($data->created_at)->isoFormat('D MMMM YYYY, HH:mm'), 'Waktu Aksi')->sortable('created_at'),
        ];
    }
}
