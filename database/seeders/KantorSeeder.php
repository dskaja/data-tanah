<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Data dari Excel
        $dataKantor = [
            // KANTOR POLSEK
            [
                'tanah_id' => 4, // TANAH POLSEK KALIPUCANG
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Kalipucang',
                'nama' => 'KANTOR POLSEK KALIPUCANG',
                'luas_bangunan' => 160,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec Kalipucang, Kab. Pangandaran Jawa Barat 46397',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 10, // TANAH SAT POLAIRUD
                'kategori' => 'kantor_polres',
                'polsek_nama' => null,
                'nama' => 'KANTOR SAT POLAIRUD',
                'luas_bangunan' => 200,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Pangandaran lama No. 42, Desa Pangandaran, Kec Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 2, // TANAH POLSEK PARIGI
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Parigi',
                'nama' => 'KANTOR POLSEK PARIGI',
                'luas_bangunan' => 168,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Parigi No. 429, Desa Parigi, Kec. Parigi, Kab. Pangandaran Jawa Barat 46393',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 6, // TANAH POLSEK SIDAMULIH
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Sidamulih',
                'nama' => 'KANTOR POLSEK SIDAMULIH',
                'luas_bangunan' => 183,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Sidamulih No. 158, Desa Pajaten, Kec. Sidamulih, Kab. Pangandaran Jawa Barat 46385',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 1, // TANAH POLSEK CIGUGUR
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Cigugur',
                'nama' => 'KANTOR POLSEK CIGUGUR',
                'luas_bangunan' => 157,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Jurago No. 452, Desa Cigugur, Kec. Cigugur, Kab. Pangandaran Jawa Barat 46392',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 7, // TANAH POLSEK CIJULANG
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Cijulang',
                'nama' => 'KANTOR POLSEK CIJULANG',
                'luas_bangunan' => 268,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Cijulang No. 281, Desa Cijulang, Kec. Cijulang, Kab. Pangandaran Jawa Barat 46394',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 3, // TANAH POLSEK PADAHERANG
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Padaherang',
                'nama' => 'KANTOR POLSEK PADAHERANG',
                'luas_bangunan' => 220,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Pangandaran No. 495, Desa Padaherang, Kec. Padaherang Kab. Pangandaran Jawa Barat 46384',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 9, // TANAH POLSEK CIMERAK
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Cimerak',
                'nama' => 'KANTOR POLSEK CIMERAK',
                'luas_bangunan' => 113,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Cimerak No. 35, Desa Cimerak, Kec. Cimerak, Kab. Pangandaran Jawa Barat 46395',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 8, // TANAH POLSEK LANGKAPLANCAR
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Langkaplancar',
                'nama' => 'KANTOR POLSEK LANGKAPLANCAR',
                'luas_bangunan' => 154,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Bangunjaya No. 35, Desa Bangunjaya Kec. Langkaplancar, Kab. Pangandaran Jawa Barat 46391',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tanah_id' => 5, // TANAH POLSEK PANGANDARAN
                'kategori' => 'kantor_polsek',
                'polsek_nama' => 'Pangandaran',
                'nama' => 'KANTOR POLSEK PANGANDARAN',
                'luas_bangunan' => 525,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // KANTOR POLRES
            [
                'tanah_id' => 11, // TANAH POLRES PANGANDARAN
                'kategori' => 'kantor_polres',
                'polsek_nama' => null,
                'nama' => 'KANTOR POLRES PANGANDARAN',
                'luas_bangunan' => 3300,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Cijulang No. 69 Desa Wonoharjo Kec. Pangandaran Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert ke database
        DB::table('kantor')->insert($dataKantor);
        
        $this->command->info('✅ Seeder Kantor berhasil dijalankan!');
        $this->command->info('📊 Total data: ' . count($dataKantor) . ' bangunan kantor');
    }
}