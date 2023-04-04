<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = Store::all();
        $categories = ["Shirts", "Pants", "Shoes", "Accessories"];
        foreach ($categories as $c ) {
            $category = Category::create([
                'name' => $c,
            ]);

            for ($i = 0; $i < 10; $i++) {
                Product::create([
                    'name' => fake()->colorName,
                    'thumbnail' => fake()->imageUrl,
                    'weight' => fake()->numberBetween(100, 1000),
                    'stock' => fake()->numberBetween(1, 100),
                    'price' => fake()->numberBetween(40000, 180000),
                    'description' => fake()->text,
                    'category_id' => $category->id,
                    'store_id' => $store->random()->id
                ]);
            }


        }
        
        // for ($i = 0; $i < 10; $i++) {
        //     $product = Product::create([
        //         'name' => fake()->colorName,
        //         'thumbnail' => fake()->imageUrl,
        //         'weight' => fake()->numberBetween(100, 1000),
        //         'stock' => fake()->numberBetween(1, 100),
        //         'price' => fake()->numberBetween(40000, 180000),
        //         'description' => fake()->text
        //     ])->Category()->create([
        //         'name' => "Tops",
        //     ]);
        // }
        // for ($i = 0; $i < 10; $i++) {
        //     $product = Product::create([
        //         'name' => fake()->colorName,
        //         'thumbnail' => fake()->imageUrl,
        //         'weight' => fake()->numberBetween(100, 1000),
        //         'stock' => fake()->numberBetween(1, 100),
        //         'price' => fake()->numberBetween(100000, 300000),
        //         'description' => fake()->text
        //     ])->Category()->create([
        //         'name' => "Pants",
        //     ]);
        // }
        // for ($i = 0; $i < 10; $i++) {
        //     $product = Product::create([
        //         'name' => fake()->colorName,
        //         'thumbnail' => fake()->imageUrl,
        //         'weight' => fake()->numberBetween(100, 1000),
        //         'stock' => fake()->numberBetween(1, 100),
        //         'price' => fake()->numberBetween(10000, 99000),
        //         'description' => fake()->text
        //     ])->Category()->create([
        //         'name' => "Accessories",
        //     ]);
        // }
    }
}
