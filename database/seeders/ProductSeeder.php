<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([

            'name' => 'Manchester United Shirt',
            'slug' => Str::slug('Manchester United Shirt'),
            'description' => 'Manchester united football club shirt',
            'price' => 45,
            'category_id' => 1

        ]);
    }
}
