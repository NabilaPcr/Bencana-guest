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
            // Insert kejadian bencana
            $kejadianId = DB::table('kejadian_bencana')->insertGetId([
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

            // 50% kemungkinan insert data ke tabel media (hanya ref id dan table)
            if ($faker->boolean(50)) {
                // Jumlah data media random (1-3)
                $jumlahMedia = $faker->numberBetween(1, 3);

                for ($j = 0; $j < $jumlahMedia; $j++) {
                    DB::table('media')->insert([
                        'ref_table'  => 'kejadian_bencana',
                        'ref_id'     => $kejadianId,
                        'file_name'  => 'kejadian_' . $kejadianId . '_' . ($j + 1) . '.jpg', // Nama dummy
                        'caption'    => $faker->optional(0.3)->sentence(),
                        'mime_type'  => 'image/jpeg',
                        'sort_order' => $j + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->command->info('KejadianBencanaSeeder berhasil dijalankan!');
        $this->command->info('50% kejadian memiliki data di tabel media (tapi file tidak ada).');
    }
}




















//     public function run()
//     {
//         $faker = Faker::create('id_ID');

//         for ($i = 1; $i <= 100; $i++) {
//             DB::table('kejadian_bencana')->insert([
//                 'jenis_bencana'  => $faker->randomElement([
//                     'Banjir', 'Longsor', 'Gempa', 'Kebakaran',
//                     'Angin Puting Beliung', 'Tanah Retak',
//                 ]),
//                 'tanggal'        => $faker->date('Y-m-d'),
//                 'lokasi_text'    => $faker->streetAddress,
//                 'rt'             => $faker->numberBetween(1, 10),
//                 'rw'             => $faker->numberBetween(1, 10),
//                 'dampak'         => $faker->randomElement([
//                     'Kerusakan ringan pada beberapa rumah warga',
//                     'Rumah warga terendam air setinggi 50 cm',
//                     'Akses jalan utama terputus',
//                     'Beberapa fasilitas umum rusak',
//                     'Warga dievakuasi ke tempat aman',
//                     'Tanah ambles dan merusak saluran air',
//                 ]),
//                 'status_kejadian'=> $faker->randomElement([
//                     'aktif', 'selesai', 'dalam penanganan'
//                 ]),
//                 'keterangan'     => $faker->optional(0.3)->sentence(),
//                 'created_at'     => now(),
//                 'updated_at'     => now(),
//             ]);
//         }

//     }
// }
