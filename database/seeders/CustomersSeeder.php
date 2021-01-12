<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Customers::factory()->count(50)->create();
    }
}
