<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Data dari Excel
        $dataTanah = [
            // POLSEK (9 data) - ID 1-9
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Cigugur',
                'nama' => 'TANAH POLSEK CIGUGUR',
                'alamat' => 'Jalan Jurago No. 452, Desa Cigugur, Kec. Cigugur, Kab. Pangandaran Jawa Barat 46392',
                'luas_seluruhnya' => 867,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Parigi',
                'nama' => 'TANAH POLSEK PARIGI',
                'alamat' => 'Jalan Raya Parigi No. 429, Desa Parigi Kec. Parigi, Kab. Pangandaran Jawa Barat 46393',
                'luas_seluruhnya' => 500,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Padaherang',
                'nama' => 'TANAH POLSEK PADAHERANG',
                'alamat' => 'Jalan Raya Pangandaran No. 495, Desa Padaherang, Kec. Padaherang Kab. Pangandaran Jawa Barat 46384',
                'luas_seluruhnya' => 2917,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Pinjam pakai',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Kalipucang',
                'nama' => 'TANAH POLSEK KALIPUCANG', // ID 4
                'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397',
                'luas_seluruhnya' => 950,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Pinjam pakai',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Pangandaran',
                'nama' => 'TANAH POLSEK PANGANDARAN', // ID 5
                'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'luas_seluruhnya' => 4496,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Sidamulih',
                'nama' => 'TANAH POLSEK SIDAMULIH', // ID 6
                'alamat' => 'Jalan Raya Sidamulih No. 158, Desa Pajaten, Kec. Sidamulih, Kab. Pangandaran Jawa Barat 46385',
                'luas_seluruhnya' => 840,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Cijulang',
                'nama' => 'TANAH POLSEK CIJULANG',
                'alamat' => 'Jalan Raya Cijulang No. 281, Desa Cijulang, Kec. Cijulang, Kab. Pangandaran Jawa Barat 46394',
                'luas_seluruhnya' => 1400,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Pinjam pakai',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Langkaplancar',
                'nama' => 'TANAH POLSEK LANGKAP LANCAR',
                'alamat' => 'Jalan Bangunjaya No. 35, Desa Bangunjaya Kec. Langkaplancar, Kab. Pangandaran Jawa Barat 46391',
                'luas_seluruhnya' => 1500,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Pinjam pakai',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polsek',
                'polsek_nama' => 'Polsek Cimerak',
                'nama' => 'TANAH POLSEK CIMERAK',
                'alamat' => 'Jalan Raya Cimerak No. 35, Desa Cimerak, Kec. Cimerak, Kab. Pangandaran Jawa Barat 46395',
                'luas_seluruhnya' => 349,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Pinjam pakai',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // POLRES (2 data) - ID 10-11
            [
                'kategori' => 'polres',
                'polsek_nama' => null,
                'nama' => 'TANAH SAT POLAIRUD', // ID 10
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'luas_seluruhnya' => 3000,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori' => 'polres',
                'polsek_nama' => null,
                'nama' => 'TANAH POLRES PANGANDARAN', // ID 11
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46396',
                'luas_seluruhnya' => 50000,
                'luas_tanah_bangunan' => 0,
                'luas_tanah_sarana' => 0,
                'status' => 'Sertifikat',
                'foto' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert ke database
        DB::table('tanah')->insert($dataTanah);
        
        $this->command->info('✅ Seeder Tanah berhasil dijalankan!');
        $this->command->info('📊 Total data: ' . count($dataTanah));
        $this->command->info('   - Polsek: 9 data (ID 1-9)');
        $this->command->info('   - Polres: 2 data (ID 10-11: SAT POLAIRUD + POLRES PANGANDARAN)');
        $this->command->info('');
        $this->command->info('📌 CATATAN PENTING - Mapping Tanah ID:');
        $this->command->info('   ID 4  = TANAH POLSEK KALIPUCANG (Jl. Raya Kalipucang No. 396)');
        $this->command->info('   ID 5  = TANAH POLSEK PANGANDARAN (Jl. Merdeka No. 175)');
        $this->command->info('   ID 6  = TANAH POLSEK SIDAMULIH (Jl. Raya Sidamulih No. 158)');
        $this->command->info('   ID 10 = TANAH SAT POLAIRUD (Jl. Pengadilan lama No. 45)');
        $this->command->info('   ID 11 = TANAH POLRES PANGANDARAN (Jl. Raya Cijulang No. 69)');
    }
}