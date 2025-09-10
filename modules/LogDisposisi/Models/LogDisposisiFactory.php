<?php

namespace Modules\LogDisposisi\Models;

use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LogDisposisi>
 */
class LogDisposisiFactory extends Factory
{
    /** @var class-string<LogDisposisi> */
    protected $model = LogDisposisi::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->words(3, true),
            'action' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
        ];
    }
}
