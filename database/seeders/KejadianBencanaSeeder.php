<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KejadianBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {
            DB::table('kejadian_bencana')->insert([
                'jenis_bencana'  => $faker->randomElement([
                    'Banjir', 'Longsor', 'Gempa', 'Kebakaran',
                    'Angin Puting Beliung', 'Tanah Retak',
                ]),
                'tanggal'        => $faker->date('Y-m-d'),
                'lokasi_text'    => $faker->streetAddress,
                'rt'             => $faker->numberBetween(1, 10),
                'rw'             => $faker->numberBetween(1, 10),
                'dampak'         => $faker->randomElement([
                    'Kerusakan ringan pada beberapa rumah warga',
                    'Rumah warga terendam air setinggi 50 cm',
                    'Akses jalan utama terputus',
                    'Beberapa fasilitas umum rusak',
                    'Warga dievakuasi ke tempat aman',
                    'Tanah ambles dan merusak saluran air',
                ]),
                'status_kejadian'=> $faker->randomElement([
                    'aktif', 'selesai', 'dalam penanganan'
                ]),
                'keterangan'     => $faker->optional(0.3)->sentence(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        // $this->command->info("✅ 20 data KejadianBencana berhasil dibuat!");
    }
}
