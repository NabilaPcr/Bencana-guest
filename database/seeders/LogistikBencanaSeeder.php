<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LogistikBencanaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data lama jika perlu
        // DB::table('logistik_bencana')->truncate();

        // Ambil semua kejadian_id yang tersedia
        $kejadianIds = DB::table('kejadian_bencana')->pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->info('⚠️  Tidak ada data kejadian_bencana! Jalankan KejadianBencanaSeeder terlebih dahulu.');
            return;
        }

        $logistikData = [];

        foreach ($kejadianIds as $kejadianId) {
            // Tentukan jumlah barang untuk setiap kejadian (3-15 barang)
            $jumlahBarang = $faker->numberBetween(3, 15);

            for ($i = 0; $i < $jumlahBarang; $i++) {
                // Generate nama barang yang lebih variatif dengan Faker
                $jenisBarang = $faker->randomElement([
                    'makanan' => [
                        'Beras', 'Mie Instan', 'Telur', 'Susu', 'Biskuit',
                        'Kornet', 'Sarden', 'Kacang', 'Minyak Goreng', 'Gula',
                        'Garam', 'Kopi', 'Teh', 'Susu Bubuk', 'Sereal',
                        'Roti', 'Buah Kaleng', 'Sayur Kaleng', 'Madu', 'Selai'
                    ],
                    'minuman' => [
                        'Air Mineral', 'Air Galon', 'Susu UHT', 'Jus', 'Sirup',
                        'Minuman Isotonik', 'Kopi Sachet', 'Teh Celup', 'Susu Kental'
                    ],
                    'pakaian' => [
                        'Kaos', 'Celana', 'Jaket', 'Sarung', 'Mukena',
                        'Sajadah', 'Handuk', 'Sepatu', 'Sandal', 'Topi',
                        'Selimut', 'Sarung Tangan', 'Kaus Kaki', 'Pakaian Dalam'
                    ],
                    'perlengkapan' => [
                        'Tenda', 'Terpal', 'Matras', 'Sprei', 'Bantal',
                        'Sleeping Bag', 'Kursi Lipat', 'Meja Lipat', 'Lampu Darurat',
                        'Senter', 'Baterai', 'Kabel Extension', 'Power Bank'
                    ],
                    'kesehatan' => [
                        'Obat Demam', 'Obat Pusing', 'Plester', 'Perban', 'Betadine',
                        'Masker', 'Hand Sanitizer', 'Sabun', 'Shampoo', 'Pasta Gigi',
                        'Sikat Gigi', 'Popok', 'Pembalut', 'Tisu Basah', 'Kapas',
                        'Alkohol', 'Termometer', 'Obat Batuk', 'Obat Diare', 'Vitamin'
                    ],
                    'peralatan' => [
                        'Kompor Gas', 'Gas LPG', 'Panci', 'Wajan', 'Piring',
                        'Gelas', 'Sendok', 'Garpu', 'Pisau', 'Talenan',
                        'Termos', 'Cooler Box', 'Korek Api', 'Pemantik', 'Kemasan Plastik'
                    ],
                    'lainnya' => [
                        'Buku Tulis', 'Pensil', 'Pulpen', 'Penggaris', 'Penghapus',
                        'Mainan Anak', 'Buku Cerita', 'Radio', 'Whistle', 'Peta',
                        'Kompas', 'Peluit', 'Tali', 'Gunting', 'Cutter'
                    ]
                ]);

                $namaBarang = $faker->randomElement($jenisBarang);

                // Tentukan satuan berdasarkan jenis barang
                $satuan = $this->getSatuanByJenisBarang($namaBarang, $faker);

                // Generate stok berdasarkan satuan
                $stok = $this->generateStokBySatuan($satuan, $faker);

                // Generate sumber logistik (bisa string atau null)
                $sumber = $this->generateSumberLogistik($faker);

                $logistikData[] = [
                    'kejadian_id' => $kejadianId,
                    'nama_barang' => $namaBarang,
                    'satuan' => $satuan,
                    'stok' => $stok,
                    'sumber' => $sumber,
                    'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('logistik_bencana')->insert($logistikData);
    }

    /**
     * Mendapatkan satuan berdasarkan jenis barang
     */
    private function getSatuanByJenisBarang(string $namaBarang, $faker): string
    {
        $satuanMapping = [
            // Satuan berat
            'Beras' => 'kg', 'Gula' => 'kg', 'Garam' => 'kg', 'Kopi' => 'kg',
            'Susu Bubuk' => 'kg', 'Madu' => 'kg', 'Selai' => 'kg', 'Kacang' => 'kg',

            // Satuan liter
            'Air Mineral' => 'liter', 'Air Galon' => 'liter', 'Minyak Goreng' => 'liter',
            'Sirup' => 'liter', 'Susu UHT' => 'liter', 'Jus' => 'liter',
            'Minuman Isotonik' => 'liter', 'Susu Kental' => 'liter',

            // Satuan buah/pcs
            'Telur' => 'butir', 'Tenda' => 'buah', 'Matras' => 'buah', 'Bantal' => 'buah',
            'Sleeping Bag' => 'buah', 'Senter' => 'buah', 'Power Bank' => 'buah',
            'Kompor Gas' => 'buah', 'Termos' => 'buah', 'Radio' => 'buah',
            'Lampu Darurat' => 'buah', 'Kursi Lipat' => 'buah', 'Meja Lipat' => 'buah',
            'Kaos' => 'buah', 'Celana' => 'buah', 'Jaket' => 'buah', 'Sarung' => 'buah',
            'Mukena' => 'buah', 'Sajadah' => 'buah', 'Handuk' => 'buah', 'Sepatu' => 'pasang',
            'Sandal' => 'pasang', 'Topi' => 'buah', 'Selimut' => 'buah', 'Sarung Tangan' => 'pasang',
            'Kaus Kaki' => 'pasang', 'Pakaian Dalam' => 'buah', 'Baterai' => 'buah',
            'Kabel Extension' => 'buah', 'Panci' => 'buah', 'Wajan' => 'buah',
            'Piring' => 'buah', 'Gelas' => 'buah', 'Sendok' => 'buah', 'Garpu' => 'buah',
            'Pisau' => 'buah', 'Talenan' => 'buah', 'Cooler Box' => 'buah',
            'Korek Api' => 'kotak', 'Pemantik' => 'buah', 'Buku Tulis' => 'buah',
            'Pensil' => 'buah', 'Pulpen' => 'buah', 'Penggaris' => 'buah',
            'Penghapus' => 'buah', 'Mainan Anak' => 'buah', 'Buku Cerita' => 'buah',
            'Whistle' => 'buah', 'Peta' => 'buah', 'Kompas' => 'buah',
             'Tali' => 'gulung', 'Gunting' => 'buah', 'Cutter' => 'buah',

            // Satuan pak
            'Mie Instan' => 'bungkus', 'Biskuit' => 'bungkus', 'Kornet' => 'kaleng',
            'Sarden' => 'kaleng', 'Buah Kaleng' => 'kaleng', 'Sayur Kaleng' => 'kaleng',
            'Kopi Sachet' => 'sachet', 'Teh Celup' => 'buah', 'Popok' => 'pak',
            'Pembalut' => 'pak', 'Masker' => 'box', 'Obat Demam' => 'strip',
            'Obat Pusing' => 'strip', 'Plester' => 'box', 'Perban' => 'gulung',
            'Betadine' => 'botol', 'Hand Sanitizer' => 'botol', 'Sabun' => 'batang',
            'Shampoo' => 'botol', 'Pasta Gigi' => 'tube', 'Sikat Gigi' => 'buah',
            'Tisu Basah' => 'pak', 'Kapas' => 'pak', 'Alkohol' => 'botol',
            'Termometer' => 'buah', 'Obat Batuk' => 'botol', 'Obat Diare' => 'strip',
            'Vitamin' => 'botol', 'Gas LPG' => 'tabung', 'Kemasan Plastik' => 'pak',
            'Roti' => 'bungkus', 'Sereal' => 'kotak', 'Susu' => 'kaleng',
            'Sprei' => 'buah',

            // Satuan set
            'Peralatan Masak' => 'set', 'P3K Kit' => 'set', 'Alat Tulis' => 'set',

            // Default satuan
            'default' => $faker->randomElement(['buah', 'kg', 'liter', 'pak', 'set', 'bungkus', 'botol'])
        ];

        return $satuanMapping[$namaBarang] ?? $satuanMapping['default'];
    }

    /**
     * Generate stok berdasarkan satuan
     */
    private function generateStokBySatuan(string $satuan, $faker): int
    {
        $range = match($satuan) {
            'kg' => [10, 500],
            'liter' => [20, 1000],
            'buah', 'buah' => [5, 100],
            'bungkus', 'kaleng', 'sachet' => [20, 500],
            'pak' => [10, 200],
            'box' => [5, 50],
            'set' => [2, 30],
            'butir' => [50, 1000],
            'botol' => [20, 300],
            'tube' => [15, 150],
            'strip' => [10, 100],
            'batang' => [50, 500],
            'gulung' => [5, 50],
            'pasang' => [10, 200],
            'kotak' => [10, 100],
            'tabung' => [5, 30],
            'galon' => [10, 100],
            default => [10, 100],
        };

        return $faker->numberBetween($range[0], $range[1]);
    }

    /**
     * Generate sumber logistik yang variatif
     * Mengembalikan string|null
     */
    private function generateSumberLogistik($faker): ?string
    {
        if ($faker->boolean(30)) {
            return null;
        }

        $tipeSumber = $faker->randomElement([
            'pemerintah' => [
                'Bantuan Pemerintah Pusat',
                'Bantuan Pemerintah Provinsi',
                'Bantuan Pemerintah Kabupaten/Kota',
                'Bantuan BPBD ' . $faker->city(),
                'Bantuan Kementerian Sosial',
                'Bantuan Kementerian Kesehatan',
                'Bantuan TNI ' . $faker->randomElement(['Kodim', 'Korem', 'Kodam']),
                'Bantuan Polri ' . $faker->randomElement(['Polres', 'Polda']),
                'Bantuan BNPB',
            ],
            'perusahaan' => [
                'Donasi ' . $faker->company(),
                'CSR ' . $faker->company() . ' Group',
                'Bantuan ' . $faker->company() . ' Indonesia',
                'PT. ' . $faker->company(),
                'CV. ' . $faker->company(),
                'UD. ' . $faker->company(),
            ],
            'organisasi' => [
                'PMI ' . $faker->city(),
                'Bantuan ' . $faker->randomElement(['LSM', 'NGO']) . ' ' . $faker->companySuffix(),
                'Yayasan ' . $faker->lastName(),
                'Koperasi ' . $faker->city(),
                'Organisasi ' . $faker->randomElement(['Pemuda', 'Wanita', 'Mahasiswa']),
            ],
            'keagamaan' => [
                'Bantuan ' . $faker->randomElement(['Masjid', 'Gereja', 'Pura', 'Vihara', 'Kuil']) . ' ' . $faker->city(),
                'Donasi Umat ' . $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha']),
                $faker->randomElement(['MU', 'PMK', 'UKMI', 'PERMADHIS']) . ' ' . $faker->city(),
            ],
            'masyarakat' => [
                'Donasi Warga ' . $faker->city(),
                'Sumbangan Masyarakat ' . $faker->streetName(),
                'Penggalangan Dana ' . $faker->randomElement(['Online', 'Langsung', 'Via Transfer']),
                'Bantuan Tetangga',
                'Donasi Keluarga Korban',
                'Sumbangan RT/RW ' . $faker->numberBetween(1, 20),
            ],
            'individu' => [
                'Bapak ' . $faker->name('male'),
                'Ibu ' . $faker->name('female'),
                'Keluarga ' . $faker->lastName(),
                'Sdr. ' . $faker->firstName(),
                'An. ' . $faker->name(),
            ],
            'internasional' => [
                'Bantuan ' . $faker->randomElement(['UNICEF', 'WHO', 'UNHCR', 'Red Cross']),
                'Donasi ' . $faker->country() . ' Government',
                $faker->randomElement(['USAID', 'JICA', 'AusAID', 'DFID']),
                'Bantuan Internasional ' . $faker->randomElement(['Team', 'Foundation', 'Agency']),
            ]
        ]);

        return $faker->randomElement($tipeSumber);
    }
}
