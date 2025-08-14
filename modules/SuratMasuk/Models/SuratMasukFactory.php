<?php

namespace Modules\SuratMasuk\Models;

use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /** @var class-string<SuratMasuk> */
    protected $model = SuratMasuk::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->words(3, true),
            'sifat_naskah' => $this->faker->words(3, true),
            'nama_pengirim' => $this->faker->words(3, true),
            'jabatan_pengirim' => $this->faker->words(3, true),
            'instansi_pengirim' => $this->faker->words(3, true),
            'nomor_naskah' => $this->faker->words(3, true),
            'tgl_naskah' => $this->faker->date(),
            'tgl_diterima' => $this->faker->date(),
            'ringkasan_isi_surat' => $this->faker->text(),
            'lampiran' => $this->faker->words(3, true),
        ];
    }
}
