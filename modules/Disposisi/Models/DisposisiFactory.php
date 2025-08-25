<?php

namespace Modules\Disposisi\Models;

use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Disposisi>
 */
class DisposisiFactory extends Factory
{
    /** @var class-string<Disposisi> */
    protected $model = Disposisi::class;

    public function definition(): array
    {
        return [
            'disposisi' => $this->faker->words(3, true),
        ];
    }
}
