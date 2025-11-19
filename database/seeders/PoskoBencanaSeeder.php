<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\KejadianBencana;

class PoskoBencanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua kejadian_id dari tabel kejadian_bencana
        $kejadianIDs = KejadianBencana::pluck('kejadian_id')->toArray();

        if (empty($kejadianIDs)) {
            $this->command->warn('⚠ Tidak ada data di tabel kejadian_bencana. Jalankan KejadianBencanaSeeder dulu.');
            return;
        }

        foreach (range(1, 10) as $index) {
            DB::table('posko_bencana')->insert([
                'kejadian_id'      => $faker->randomElement($kejadianIDs),

                'nama'             => 'Posko ' . $faker->citySuffix,
                'alamat'           => $faker->address,

                'kontak'           => '08' . $faker->numberBetween(100000000, 999999999),
                'penanggung_jawab' => $faker->name('id_ID'),

                // media dihapus karena kolomnya tidak ada!

                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
