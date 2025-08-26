<?php

namespace Modules\LogSuratMasuk\Models;

use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LogSuratMasuk>
 */
class LogSuratMasukFactory extends Factory
{
    /** @var class-string<LogSuratMasuk> */
    protected $model = LogSuratMasuk::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->words(3, true),
            'action' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
        ];
    }
}
