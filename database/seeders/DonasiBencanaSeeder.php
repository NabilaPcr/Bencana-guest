<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DonasiBencanaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data lama jika perlu
        DB::table('donasi_bencana')->truncate();

        // Ambil semua kejadian_id yang tersedia
        $kejadianIds = DB::table('kejadian_bencana')->pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->info('⚠️  Tidak ada data kejadian_bencana! Jalankan KejadianBencanaSeeder terlebih dahulu.');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            $jenis = $faker->randomElement(['uang', 'barang']);

            // Acak antara donatur individu dan organisasi
            $isOrganization = $faker->boolean(60);

            if ($isOrganization) {
                $donaturNama = $faker->randomElement([
                    'PT. ' . $faker->company(),
                    'CV. ' . $faker->company(),
                    'UD. ' . $faker->company(),
                    'Yayasan ' . $faker->company(),
                    'Koperasi ' . $faker->company(),
                    $faker->company() . ' Group',
                ]);
            } else {
                $donaturNama = $faker->randomElement([
                    $faker->name(),
                    'Bpk. ' . $faker->name(),
                    'Ibu ' . $faker->name(),
                    'Keluarga ' . $faker->lastName(),
                ]);
            }

            // Insert data donasi
            $donasiId = DB::table('donasi_bencana')->insertGetId([
                'kejadian_id'   => $faker->randomElement($kejadianIds),
                'donatur_nama'  => $donaturNama,
                'jenis'         => $jenis,
                'nilai'         => $jenis == 'uang'
                    ? $faker->numberBetween(100000, 10000000)
                    : $faker->numberBetween(10, 1000),
                'created_at'    => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at'    => now(),
            ]);

            if ($faker->boolean(80)) {
                // Tentukan jenis gambar berdasarkan jenis donasi
                if ($jenis == 'uang') {
                    $gambarTypes = [
                        ['file' => 'placeholder.jpg', 'caption' => 'placeholder'],
                    ];
                } else {
                    $gambarTypes = [
                        ['file' => 'barang-bantuan.jpg', 'caption' => 'Barang Bantuan'],
                        ['file' => 'paket-sembako.jpg', 'caption' => 'Paket Sembako'],
                        ['file' => 'logistik-donasi.jpg', 'caption' => 'Logistik Donasi'],
                    ];
                }

                $selectedGambar = $faker->randomElement($gambarTypes);

                DB::table('media')->insert([
                    'ref_table'    => 'donasi_bencana',
                    'ref_id'       => $donasiId,
                    'file_name'    => $selectedGambar['file'],
                    'caption'      => $selectedGambar['caption'] . ' - ' . $donaturNama,
                    'mime_type'    => 'image/jpeg',
                    'sort_order'   => 1,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                if ($faker->boolean(30)) {
                    DB::table('media')->insert([
                        'ref_table'    => 'donasi_bencana',
                        'ref_id'       => $donasiId,
                        'file_name'    => 'dokumentasi-donasi.jpg',
                        'caption'      => 'Dokumentasi Penyerahan - ' . $donaturNama,
                        'mime_type'    => 'image/jpeg',
                        'sort_order'   => 2,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                }
            }
        }

        $this->command->info("✅ 50 data DonasiBencana berhasil dibuat!");
    }
}
