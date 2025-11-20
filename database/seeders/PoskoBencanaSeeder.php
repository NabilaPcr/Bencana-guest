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

        for ($i = 1; $i <= 10; $i++) {
            DB::table('posko_bencana')->insert([
                'kejadian_id'       => $faker->numberBetween(1, 20),
                'nama'              => 'Posko ' . $faker->companySuffix(),
                'alamat'            => $faker->address(),
                'kontak'            => $faker->phoneNumber(),
                'penanggung_jawab'  => $faker->name(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
