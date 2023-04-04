<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Address;
use App\Models\Review;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     'email' => 'adiviaka@gmail.com',
        //     'password' => bcrypt('adiviaka')
        // ]);
        // User::create([
        //     'email' => 'alyasemarang@gmail.com',
        //     'password' => bcrypt('alyasemarang')
        // ]);
        // User::create([
        //     'email' => 'farrelay@gmail.com',
        //     'password' => bcrypt('farrelay')
        // ]);
        // User::create([
        //     'email' => 'davidepp@gmail.com',
        //     'password' => bcrypt('davidepp')
        // ]);

        // UserDetail::create([
        //     'user_id' => 1,
        //     'first_name' => 'Adivia',
        //     'last_name' => 'Khusnul Aisha',
        //     'profile' => '',
        //     'birthdate'=> '2002-10-24',
        //     'gender' => 2,
        //     'contact' => '082138682404'
        // ]);
        // UserDetail::create([
        //     'user_id' => 2,
        //     'first_name' => 'Alya',
        //     'last_name' => 'Zahra Fatikha',
        //     'profile' => '',
        //     'birthdate'=> '2002-06-28',
        //     'gender' => 2,
        //     'contact' => '088221278858'
        // ]);

        // Address::create([
        //     'user_detail_id' => 1,
        //     'address' => 'Jl. Afa Permai IV/6',
        //     'village' => 'Sendangmulyo',
        //     'district' => 'Tembalang',
        //     'city' => 'Semarang',
        //     'province' => 'Central Java',
        //     'postal_code' => '50272'
        // ]);
        // Address::create([
        //     'user_detail_id' => 2,
        //     'address' => 'Jl. Mangunharjo 1',
        //     'village' => 'Mangunharjo',
        //     'district' => 'Tembalang',
        //     'city' => 'Semarang',
        //     'province' => 'Central Java',
        //     'postal_code' => '50272'
        // ]);

        // Review::create([
        //     'user_id' => 1,
        //     'product_id' => 1,
        //     'review' => 'Sangat bagus',
        //     'rating' => 5
        // ]);
        // Review::create([
        //     'user_id' => 2,
        //     'product_id' => 1,
        //     'review' => 'Sangat bagus',
        //     'rating' => 5
        // ]);
        // Review::create([
        //     'user_id' => 1,
        //     'product_id' => 2,
        //     'review' => 'Sangat bagus',
        //     'rating' => 5
        // ]);
        // Review::create([
        //     'user_id' => 3,
        //     'product_id' => 2,
        //     'review' => 'Sangat bagus',
        //     'rating' => 5
        // ]);

        // Store::create([
        //     'user_id' => 1,
        //     'name' => 'Adivia Store',
        //     'logo' => 'https://i.ibb.co/0nZ3Z3T/Logo.png',
        //     'address' => 'Jl. Afa Permai IV/6',
        //     'village' => 'Sendangmulyo',
        //     'district' => 'Tembalang',
        //     'city' => 'Semarang',
        //     'province' => 'Central Java',
        //     'postal_code' => '50272',
        //     'contact' => '082138682404',
        //     'description' => 'This is a Fashion Store',
        //     'VA' => '1234567890'
        // ]);
        // Store::create([
        //     'user_id' => 2,
        //     'name' => 'Alya Store',
        //     'logo' => 'https://i.ibb.co/0nZ3Z3T/Logo.png',
        //     'address' => 'Jl. Mangunharjo 1',
        //     'village' => 'Mangunharjo',
        //     'district' => 'Tembalang',
        //     'city' => 'Semarang',
        //     'province' => 'Central Java',
        //     'postal_code' => '50272',
        //     'contact' => '088221278858',
        //     'description' => 'This is a Accessories Store',
        //     'VA' => '1234567890'
        // ]);

        // Product::create([
        //     'store_id' => 1,
        //     'category_id' => 1,
        //     'thumbnail' => 'https://i.ibb.co/0nZ3Z3T/Logo.png',
        //     'name' => 'Crop Tee',
        //     'weight' => 300,
        //     'price' => 99000,
        //     'stock' => 10,
        //     'description' => 'This is a Crop Tee'
        // ]);
        // Product::create([
        //     'store_id' => 2,
        //     'category_id' => 2,
        //     'thumbnail' => 'https://i.ibb.co/0nZ3Z3T/Logo.png',
        //     'name' => 'Butterfly Earrings',
        //     'weight' => 200,
        //     'price' => 65000,
        //     'stock' => 20,
        //     'description' => 'Accessories to make you look more beautiful'
        // ]);

        // Category::create([
        //     'id' => 1,
        //     'name' => 'Tops'
        // ]);
        // Category::create([
        //     'id' => 2,
        //     'name' => 'Accessories'
        // ]);
    }
}
