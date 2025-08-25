<?php

namespace Modules\DisposisiKepada\Models;

use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DisposisiKepada>
 */
class DisposisiKepadaFactory extends Factory
{
    /** @var class-string<DisposisiKepada> */
    protected $model = DisposisiKepada::class;

    public function definition(): array
    {
        return [
            'disposisi_kepada' => $this->faker->text(),
        ];
    }
}
