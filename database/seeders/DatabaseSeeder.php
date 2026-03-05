<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ================================================
        // URUTAN INI PENTING BANGET!
        // 
        // 1. UserSeeder    → dibutuhkan created_by
        // 2. TanahSeeder   → dibutuhkan tanah_id
        // 3. Bangunan      → pakai created_by + tanah_id
        // ================================================

        // Step 1: User dulu (semua seeder pakai created_by = 1)
        $this->call(UserSeeder::class);

        // Step 2: Tanah dulu (semua bangunan butuh tanah_id)
        $this->call(TanahSeeder::class);

        // Step 3: Bangunan (setelah tanah ada)
        $this->call([
            KantorSeeder::class,
            RumdinSeeder::class,
            BarakSeeder::class,
            GarasiSeeder::class,
            MusholaSeeder::class,
        ]);
    }
}