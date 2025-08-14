<?php

namespace Modules\JenisSurat\Models;

use Modules\JenisSurat\Models\JenisSurat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JenisSurat>
 */
class JenisSuratFactory extends Factory
{
    /** @var class-string<JenisSurat> */
    protected $model = JenisSurat::class;

    public function definition(): array
    {
        return [
            'jenis_surat' => $this->faker->words(3, true),
        ];
    }
}
