<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanah', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['polres', 'polsek']); // Polres atau Polsek
            $table->string('polsek_nama')->nullable(); // Nama polsek jika kategori = polsek
            // HAPUS kolom 'nomor' - karena udah ada id (auto increment)
            $table->string('nama'); // Nama
            $table->text('alamat'); // Alamat
            $table->decimal('luas_seluruhnya', 10, 2); // Luas Seluruhnya (m2) - DIGANTI NAMA
            $table->decimal('luas_tanah_bangunan', 10, 2); // Luas Tanah untuk Bangunan (m2)
            $table->decimal('luas_tanah_sarana', 10, 2); // Luas Tanah Sarana Lingkungan (m2)
            $table->enum('status', ['Pinjam pakai', 'Sertifikat']); // Status dropdown
            $table->string('foto')->nullable(); // Foto
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanah');
    }
};