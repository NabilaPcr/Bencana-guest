<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DistribusiLogistikSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data logistik yang tersedia
        $logistikItems = DB::table('logistik_bencana')
            ->select('logistik_id', 'nama_barang', 'satuan', 'stok')
            ->get();

        // Ambil data posko yang tersedia
        $poskoIds = DB::table('posko_bencana')->pluck('posko_id')->toArray();

        if ($logistikItems->isEmpty()) {
            $this->command->info('⚠️  Tidak ada data logistik_bencana! Jalankan LogistikBencanaSeeder terlebih dahulu.');
            return;
        }

        if (empty($poskoIds)) {
            $this->command->info('⚠️  Tidak ada data posko_bencana! Jalankan PoskoBencanaSeeder terlebih dahulu.');
            return;
        }

        // Hitung total distribusi yang akan dibuat
        $totalDistribusi = $faker->numberBetween(80, 150);

        for ($i = 1; $i <= $totalDistribusi; $i++) {
            // Pilih logistik secara acak
            $logistik = $faker->randomElement($logistikItems);

            // Hitung total yang sudah didistribusikan dari logistik ini
            $totalDistributed = DB::table('distribusi_logistik')
                ->where('logistik_id', $logistik->logistik_id)
                ->sum('jumlah');

            // Hitung sisa stok yang tersedia
            $availableStock = $logistik->stok - $totalDistributed;

            // Jika stok tidak mencukupi, cari logistik lain
            if ($availableStock <= 0) {
                // Cari logistik yang masih ada stok
                $availableLogistik = $logistikItems->filter(function ($item) {
                    $totalDistributed = DB::table('distribusi_logistik')
                        ->where('logistik_id', $item->logistik_id)
                        ->sum('jumlah');
                    return $item->stok - $totalDistributed > 0;
                });

                if ($availableLogistik->isEmpty()) {
                    continue; 
                }

                $logistik = $faker->randomElement($availableLogistik->toArray());
                $totalDistributed = DB::table('distribusi_logistik')
                    ->where('logistik_id', $logistik->logistik_id)
                    ->sum('jumlah');
                $availableStock = $logistik->stok - $totalDistributed;
            }

            // Tentukan jumlah distribusi (maksimal 70% dari available stock)
            $maxJumlah = min($availableStock, floor($availableStock * 0.7));
            $jumlah = $faker->numberBetween(1, max(1, $maxJumlah));

            // Generate nama penerima
            $tipePenerima = $faker->randomElement(['individu', 'keluarga', 'kelompok']);
            $penerima = match($tipePenerima) {
                'individu' => 'Bapak/Ibu ' . $faker->name(),
                'keluarga' => 'Keluarga ' . $faker->lastName(),
                'kelompok' => $faker->numberBetween(5, 20) . ' Kepala Keluarga',
                default => 'Penerima ' . $i
            };

            // Generate lokasi distribusi
            $lokasi = 'Lokasi ' . $faker->randomElement(['Posko ', 'Tenda ', 'Balai ', 'Rumah ']) .
                     $faker->randomElement(['Utama', 'Pengungsian', 'Desa', 'Warga']) . ' ' .
                     $faker->streetName();

            // Generate keterangan
            $keterangan = 'Distribusi ' . $jumlah . ' ' . $logistik->satuan . ' ' .
                         $logistik->nama_barang . ' kepada ' . $penerima . ' di ' . $lokasi;

            // Insert data distribusi
            $distribusiId = DB::table('distribusi_logistik')->insertGetId([
                'logistik_id' => $logistik->logistik_id,
                'posko_id' => $faker->randomElement($poskoIds),
                'tanggal' => $faker->dateTimeBetween('-2 months', 'now'),
                'jumlah' => $jumlah,
                'penerima' => $penerima,
                'lokasi' => $lokasi,
                'keterangan' => $keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($faker->boolean(50)) {
                // Jumlah data media random (1-3)
                $jumlahMedia = $faker->numberBetween(1, 3);

                for ($j = 0; $j < $jumlahMedia; $j++) {
                    // Buat nama file sederhana
                    $fileName = 'distribusi_' . $distribusiId . '_' . ($j + 1) . '.jpg';

                    // Buat caption
                    $caption = 'Bukti distribusi ' . $logistik->nama_barang . ' kepada ' .
                              $penerima . ' - Foto ' . ($j + 1);

                    DB::table('media')->insert([
                        'ref_table'  => 'distribusi_logistik',
                        'ref_id'     => $distribusiId,
                        'file_name'  => $fileName,
                        'caption'    => $caption,
                        'mime_type'  => 'image/jpeg',
                        'sort_order' => $j + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // $this->command->info('✅ Seeder distribusi_logistik berhasil! Data: ' . $totalDistribusi . ' distribusi.');
    }
}
