<?php

namespace Database\Factories;

use App\Models\Productimages;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductimagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Productimages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image'=>$this->faker->image(storage_path('images'),640,480, null, false),
        ];
    }
}
