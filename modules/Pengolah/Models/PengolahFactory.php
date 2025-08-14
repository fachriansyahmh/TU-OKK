<?php

namespace Modules\Pengolah\Models;

use Modules\Pengolah\Models\Pengolah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengolah>
 */
class PengolahFactory extends Factory
{
    /** @var class-string<Pengolah> */
    protected $model = Pengolah::class;

    public function definition(): array
    {
        return [
            'nama_pengolah' => $this->faker->text(),
        ];
    }
}
