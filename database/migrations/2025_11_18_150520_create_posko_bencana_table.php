<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PoskoBencanaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Misalkan kamu punya 10 posko untuk beberapa kejadian
        for ($i = 1; $i <= 10; $i++) {
            DB::table('posko_bencana')->insert([
                'kejadian_id' => $faker->numberBetween(1, 10), // sesuaikan jumlah kejadian yang ada
                'nama' => 'Posko ' . $faker->city,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
                'penanggung_jawab' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
