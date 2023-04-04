<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'seller@gmail.com',
            'password' => Hash::make('seller')
        ])->assignRole(1);
        User::create([
            'email' => 'user@gmail.com',
            'password' => Hash::make('user')
        ])->assignRole(1);
        User::create([
            'email' => 'userbaru@gmail.com',
            'password' => Hash::make('userbaru')
        ])->assignRole(2);

        UserDetail::create([
            'user_id' => 1,
            'first_name' => 'Seller',
            'last_name' => 'Asli',
            'profile' => '',
            'birthdate'=> '2002-10-24',
            'gender' => 2,
            'contact' => '082138682404'
        ]);
        UserDetail::create([
            'user_id' => 3,
            'first_name' => 'User',
            'last_name' => 'Barubanget',
            'profile' => '',
            'birthdate'=> '2000-05-20',
            'gender' => 1,
            'contact' => '082131114444'
        ]);
        
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'email' => fake()->email,
                // 'password' => bcrypt('password')
                'password' => Hash::make('password'),
                'status' => 'active'
            ])->UserDetail()->create([
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'profile' => fake()->imageUrl,
                'birthdate' => fake()->date,
                'gender' => fake()->numberBetween(1, 2),
                'contact' => fake()->phoneNumber
            ]);
            for ($j = 0; $j < 3; $j++) {
                $user->Address()->create([
                    'address' => fake()->address,
                    'village' => fake()->citysuffix,
                    'district' => fake()->cityprefix,
                    'city' => fake()->city,
                    'province' => fake()->state,
                    'postal_code' => fake()->postcode,
                ]);
            }
        }
        // $user = User::create([
        //     'email' => fake()->email,
        //     'password' => bcrypt('password')
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
    }
}
