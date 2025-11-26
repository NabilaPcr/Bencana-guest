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

        // Ambil semua kejadian_id yang tersedia
        $kejadianIds = DB::table('kejadian_bencana')->pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->info('⚠️  Tidak ada data kejadian_bencana! Jalankan KejadianBencanaSeeder terlebih dahulu.');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('posko_bencana')->insert([
                'kejadian_id'       => $faker->randomElement($kejadianIds),
                'nama'              => 'Posko ' . $faker->companySuffix(),
                'alamat'            => $faker->address(),
                'kontak'            => $faker->phoneNumber(),
                'penanggung_jawab'  => $faker->name(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        // $this->command->info("✅ 50 data PoskoBencana berhasil dibuat!");
    }
}
