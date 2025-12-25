<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel users
        DB::table('users')->truncate();

        $faker = Faker::create('id_ID');

        // Insert user admin tetap
        DB::table('users')->insert([
            'name'       => 'nabila',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password123'),
            'role'       => 'Super Admin', // TAMBAHKAN INI
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Array role yang tersedia
        $roles = ['Warga','Super Admin'];

        for ($i = 1; $i <= 100; $i++) {
            $roleIndex = rand(0, 100);
            if ($roleIndex < 70) {
                $role = 'Warga';
            } else {
                $role = 'Super Admin';
            }

            DB::table('users')->insert([
                'name'       => $faker->name(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => Hash::make('password123'),
                'role'       => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
