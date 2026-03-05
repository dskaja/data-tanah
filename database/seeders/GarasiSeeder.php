<?php

namespace Database\Seeders;

use App\Models\Garasi;
use Illuminate\Database\Seeder;

class GarasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $garasiData = [
            [
                'tanah_id' => 10, // TANAH SAT POLAIRUD - Jalan Pengadilan lama No. 45
                'nama' => 'GARASI POLAIRUD',
                'luas_bangunan' => 60.00,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($garasiData as $data) {
            Garasi::create($data);
        }

        $this->command->info('✅ Garasi seeded successfully!');
        $this->command->info('📊 Total data: ' . count($garasiData) . ' garasi');
        $this->command->info('📌 Mapping: 1 garasi → Tanah ID 10 (Sat Polairud)');
    }
}