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
                // $product->productimage()->save(\App\Models\Productimages::factory()->create(['products_id'=>$product->id]));
                // $product->batch()->save(\App\Models\Batchs::factory()->count(5)->create(['products_id'=>$product->id])
                //     ->each(function($batch){
                //         $batch->price()->save(\App\Models\Prices::factory()->create(['batchs_id'=>$batch->id]));
                //     }));
                \App\Models\Productimages::factory()->create(['products_id'=>$product->id]);
                \App\Models\Batchs::factory()->count(2)->create(['products_id'=>$product->id])
                    ->each(function($batch){
                        \App\Models\Prices::factory()->create(['batchs_id'=>$batch->id]);
                        \App\Models\Dimensions::factory()->create(['batchs_id'=>$batch->id])
                            ->each(function($dimension){
                                \App\Models\Dimensionvalues::factory()->count(3)->create(['dimensions_id'=>$dimension->id]);
                            });
                    });
            });
    }
}
