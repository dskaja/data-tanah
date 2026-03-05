<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rumdin', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['polres_rusus', 'polres_satpolairud', 'polsek_rumdin']);
            $table->string('polsek_nama')->nullable();
            $table->string('nama_bangunan');
            $table->string('type');
            $table->string('penghuni')->nullable();
            $table->decimal('luas', 10, 2);
            $table->enum('status', ['Dihuni', 'Kosong']);
            $table->enum('kondisi', ['B', 'RR', 'RB']);
            $table->text('alamat');
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rumdin');
    }
};