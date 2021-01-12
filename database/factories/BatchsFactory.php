<?php

namespace Database\Factories;

use App\Models\Batchs;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batchs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => strval($this->faker->numberBetween($min=1,$max=10)),
        ];
    }
}
