<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SuratMasukImport;

class ImportSuratMasukCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:surat-masuk {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data surat masuk dari file spreadsheet (xlsx, csv)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File tidak ditemukan di path: {$file}");
            return 1;
        }

        $this->info("Memulai proses impor dari file: {$file}");

        try {
            Excel::import(new SuratMasukImport, $file);
            $this->info('Proses impor berhasil diselesaikan!');
        } catch (\Exception $e) {
            $this->error('Terjadi error saat proses impor:');
            $this->error($e->getMessage());
        }

        return 0;
    }
}