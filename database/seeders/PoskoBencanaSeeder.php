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
            // Insert data posko
            $poskoId = DB::table('posko_bencana')->insertGetId([
                'kejadian_id'       => $faker->randomElement($kejadianIds),
                'nama'              => 'Posko ' . $faker->companySuffix() . ' ' . $i,
                'alamat'            => $faker->address(),
                'kontak'            => $faker->phoneNumber(),
                'penanggung_jawab'  => $faker->name(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            // 50% kemungkinan ada data di tabel media
            if ($faker->boolean(50)) {
                // Jumlah data media random (1-3)
                $jumlahMedia = $faker->numberBetween(1, 3);

                for ($j = 0; $j < $jumlahMedia; $j++) {
                    // Buat nama file sederhana
                    $fileName = 'posko_' . $poskoId . '_' . ($j + 1) . '.jpg';

                    DB::table('media')->insert([
                        'ref_table'  => 'posko_bencana',
                        'ref_id'     => $poskoId,
                        'file_name'  => $fileName,
                        'caption'    => $faker->optional(0.3)->sentence(),
                        'mime_type'  => 'image/jpeg',
                        'sort_order' => $j + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // // Progress indicator
            // if ($i % 20 == 0) {
            //     $this->command->info("Created $i posko...");
            // }
        }

        // $this->command->info('✓ PoskoBencanaSeeder berhasil dijalankan!');
        // $this->command->info('✓ 100 data posko bencana telah dibuat');
        // $this->command->info('✓ 50% posko memiliki data di tabel media');
    }
}
