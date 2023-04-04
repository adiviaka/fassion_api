<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Alya Semarang Store',
                'logo' => 'https://i.ibb.co/0nQqZ1t/123-Store.png',
                'address'=>fake()->address,
                'contact'=>fake()->phoneNumber,
                'description' => 'This is Alya Semarang Store',
                'VA'=>fake()->bankAccountNumber
            ],
            [
                'name' => 'Farrel Ahmad Store',
                'logo' => 'https://i.ibb.co/0nQqZ1t/123-Store.png',
                'address'=>fake()->address,
                'contact'=>fake()->phoneNumber,
                'description' => 'This is Farrel Store',
                'VA'=>fake()->bankAccountNumber
            ],
        ];
        // Create Store untuk setiap user yang memiliki role_id = 1
        User::whereHas('role', function ($query) {
            $query->where('roles.id','=', 1);
        })->get()->each(function($u, $i) use ($data){
            $store = $data[$i];
            $store['user_id'] = $u->id;
            Store::create($store);
        });
}
}
