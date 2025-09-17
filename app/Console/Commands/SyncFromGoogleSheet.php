<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\SuratMasuk\Models\SuratMasuk;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Models\User;
use Modules\JenisSurat\Models\JenisSurat;
use Modules\Disposisi\Models\Disposisi;

class SyncFromGoogleSheet extends Command
{
    protected $signature = 'sync:google-sheet';
    protected $description = 'Sinkronisasi data surat masuk dari Google Sheet ke database';

    public function handle()
    {
        $this->info('Memulai sinkronisasi dari Google Sheet...');

        $values = Sheets::spreadsheet(config('google.sheet_id'))->get();
        $header = $values->pull(0);
        $data = $values->map(fn ($row) => array_combine($header, $row));

        foreach ($data as $row) {
            if (empty($row['id'])) {
                continue;
            }

            $user = !empty($row['pengolah_nama']) ? User::where('name', $row['pengolah_nama'])->first() : null;
            $jenisSurat = !empty($row['jenis_naskah_nama']) ? JenisSurat::where('jenis_surat', $row['jenis_naskah_nama'])->first() : null;
            $disposisi = !empty($row['disposisi_nama']) ? Disposisi::where('disposisi', $row['disposisi_nama'])->first() : null;

            SuratMasuk::updateOrCreate(
                ['id' => $row['id']],
                [
                    'nomor_urut' => $row['nomor_urut'],
                    'status' => $row['status'],
                    'sifat_naskah' => $row['sifat_naskah'],
                    'nama_pengirim' => $row['nama_pengirim'],
                    'jabatan_pengirim' => $row['jabatan_pengirim'],
                    'asal_pengirim' => $row['asal_pengirim'],
                    'nomor_naskah' => $row['nomor_naskah'],
                    'tgl_naskah' => !empty($row['tgl_naskah']) ? \Carbon\Carbon::parse($row['tgl_naskah']) : null,
                    'tgl_diterima' => !empty($row['tgl_diterima']) ? \Carbon\Carbon::parse($row['tgl_diterima']) : null,
                    'isi_disposisi_sekjen_deputi' => $row['isi_disposisi_sekjen_deputi'],
                    'ringkasan_isi_surat' => $row['ringkasan_isi_surat'],
                    'lampiran' => $row['lampiran'],
                    'pengolah_id' => $user->id ?? null,
                    'jenis_naskah_id' => $jenisSurat->id ?? null,
                    'disposisi_kepada' => $row['disposisi_kepada'],
                    'isi_disposisi' => $row['isi_disposisi'],
                    'disposisi_id' => $disposisi->id ?? null,
                ]
            );
        }

        $this->info('Sinkronisasi dari Google Sheet berhasil diselesaikan!');
        return 0;
    }
}