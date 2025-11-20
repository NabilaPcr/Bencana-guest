<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoskoBencanaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posko_bencana')->insert([
            [
                'kejadian_id' => 4,
                'nama' => 'Posko Ville',
                'alamat' => 'Dk. R.M. Said No. 421, Tegal 62509, Kaltim',
                'kontak' => '08147605806',
                'penanggung_jawab' => 'Gasti Suryatmi',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
