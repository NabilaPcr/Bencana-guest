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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahan: buat 5 user dummy menggunakan faker (opsional)
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name'       => $faker->name(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
