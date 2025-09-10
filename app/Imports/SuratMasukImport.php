<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\SuratMasuk\Models\SuratMasuk;
use App\Models\User;
use Modules\JenisSurat\Models\JenisSurat;
use Modules\Disposisi\Models\Disposisi;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SuratMasukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Hanya proses baris jika kolom 'status' memiliki isi.
        if (empty($row['status'])) {
            return null;
        }

        // PERBAIKAN: Logika pencarian yang lebih kuat
        $user = null;
        if (!empty($row['pengolah_nama'])) {
            $namaPengolah = trim($row['pengolah_nama']);
            $user = User::whereRaw('LOWER(name) = ?', [strtolower($namaPengolah)])->first();
        }

        $jenisSurat = null;
        if (!empty($row['jenis_naskah_nama'])) {
            $namaJenis = trim($row['jenis_naskah_nama']);
            $jenisSurat = JenisSurat::whereRaw('LOWER(jenis_surat) = ?', [strtolower($namaJenis)])->first();
        }

        $disposisi = null;
        if (!empty($row['disposisi_nama'])) {
            $namaDisposisi = trim($row['disposisi_nama']);
            $disposisi = Disposisi::whereRaw('LOWER(disposisi) = ?', [strtolower($namaDisposisi)])->first();
        }

        return new SuratMasuk([
            'status'                        => $row['status'] ?? 'Karo',
            'sifat_naskah'                  => $row['sifat_naskah'] ?? '-',
            'nama_pengirim'                 => $row['nama_pengirim'] ?? '-',
            'jabatan_pengirim'              => $row['jabatan_pengirim'] ?? '-',
            'asal_pengirim'                 => $row['asal_pengirim'] ?? '-',
            'nomor_naskah'                  => $row['nomor_naskah'] ?? '-',
            'tgl_naskah'                    => (isset($row['tgl_naskah']) && is_numeric($row['tgl_naskah'])) ? Date::excelToDateTimeObject($row['tgl_naskah']) : null,
            'tgl_diterima'                  => (isset($row['tgl_diterima']) && is_numeric($row['tgl_diterima'])) ? Date::excelToDateTimeObject($row['tgl_diterima']) : null,
            'isi_disposisi_sekjen_deputi'   => $row['isi_disposisi_sekjen_deputi'] ?? '-',
            'ringkasan_isi_surat'           => $row['ringkasan_isi_surat'] ?? '-',
            'lampiran'                      => $row['lampiran'] ?? '-',
            'pengolah_id'                   => $user->id ?? null,
            'jenis_naskah_id'               => $jenisSurat->id ?? null,
            'disposisi_kepada'              => $row['disposisi_kepada'] ?? null,
            'isi_disposisi'                 => $row['isi_disposisi'] ?? null,
            'disposisi_id'                  => $disposisi->id ?? null,
        ]);
    }
}