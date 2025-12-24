<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');


       for ($i = 1; $i <= 50; $i++) {
            $jenisKelamin = $faker->randomElement(['L', 'P']);
            $nama         = $jenisKelamin === 'L' ? $faker->firstNameMale() . ' ' . $faker->lastName() : $faker->firstNameFemale() . ' ' . $faker->lastName();

            DB::table('warga')->insert([
                'no_ktp'           => $faker->no_ktp(),
                'nama'             => $nama,
                'jenis_kelamin'    => $jenisKelamin,
                'agama'            => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'        => $faker->randomElement([
                    'Wiraswasta', 'PNS', 'Karyawan Swasta', 'Petani', 'Nelayan',
                    'Ibu Rumah Tangga', 'Pelajar/Mahasiswa', 'Buruh', 'Pedagang', 'Tidak Bekerja',
                ]),
                'telp'             => $faker->phoneNumber(),
                'email'            => $faker->optional(0.7)->email(),
                'alamat'           => $faker->streetAddress(),
                'rt'               => $faker->numberBetween(1, 10),
                'rw'               => $faker->numberBetween(1, 10),
                'keterangan'       => $faker->optional(0.3)->sentence(),
                'kebutuhan_khusus' => $faker->optional(0.2)->sentence(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
