<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Products::factory()->count(5)->create()
            ->each(function($product){
                $product->productimage()->save(\App\Models\Productimages::factory()->create(['products_id'=>$product->id]));
            });
    }
}
