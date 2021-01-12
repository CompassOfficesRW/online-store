<?php

namespace Database\Factories;

use App\Models\Productimages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;

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
        // $image = $this->faker->image(storage_path('app\public\images'));
        // $imageFile = new File($image);
        return [
            'image'=>$this->faker->image(storage_path('app/public/images'),640,480, "food", false),
            // 'image'=>Storage::disk('public')->putFile('images', $imageFile),
        ];
    }
}
