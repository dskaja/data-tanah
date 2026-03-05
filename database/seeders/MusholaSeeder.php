<?php

namespace Database\Seeders;

use App\Models\Mushola;
use Illuminate\Database\Seeder;

class MusholaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $musholaData = [
            [
                'tanah_id' => 4, // TANAH POLSEK KALIPUCANG - Jalan Raya Kalipucang No. 396
                'nama' => 'MUSHOLA POLSEK KALIPUCANG',
                'luas_bangunan' => 36.00,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Raya Kalipucang No. 396, Desa Kalipucang, Kec. Kalipucang, Kab. Pangandaran Jawa Barat 46397',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'tanah_id' => 5, // TANAH POLSEK PANGANDARAN - Jalan Merdeka No. 175
                'nama' => 'MUSHOLA POLSEK PANGANDARAN',
                'luas_bangunan' => 36.00,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Merdeka No. 175, Desa Pananjung, Kec. Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'tanah_id' => 10, // TANAH SAT POLAIRUD - Jalan Pengadilan lama No. 45
                'nama' => 'MUSHOLA POLAIRUD',
                'luas_bangunan' => 36.00,
                'bangunan_di_atas' => 'POLRI',
                'alamat' => 'Jalan Pengadilan lama No. 45, Desa Pangandaran, Kec.Pangandaran, Kab. Pangandaran Jawa Barat 46396',
                'foto' => null,
                'keterangan' => null,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($musholaData as $data) {
            Mushola::create($data);
        }

        $this->command->info('✅ Mushola seeded successfully!');
        $this->command->info('📊 Total data: ' . count($musholaData) . ' mushola');
        $this->command->info('📌 Mapping:');
        $this->command->info('   - 1 mushola → Tanah ID 4 (Polsek Kalipucang)');
        $this->command->info('   - 1 mushola → Tanah ID 5 (Polsek Pangandaran)');
        $this->command->info('   - 1 mushola → Tanah ID 10 (Sat Polairud)');
    }
}