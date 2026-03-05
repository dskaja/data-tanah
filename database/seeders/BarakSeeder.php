<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Data dari Excel
        $dataBarak = [
            // BARAK DALMAS - di Tanah Polres Pangandaran (ID 11)
            [
                'tanah_id' => 11, // Jalan Raya Cijulang No. 69
                'nama' => 'BARAK DALMAS',
                'luas_bangunan' => 1000,
                'bangunan_di_atas' => 'Halaman POLRI',
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
        DB::table('barak')->insert($dataBarak);
        
        $this->command->info('✅ Seeder Barak berhasil dijalankan!');
    }
}