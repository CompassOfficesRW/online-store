<?php

namespace Database\Factories;

use App\Models\Prices;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prices::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() 
    {
        return [
            "salesprice" => $this->faker->randomFloat($nbmaxDecimals=2,$min=1,$max=1000),
        ];
    }
}
