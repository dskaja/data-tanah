<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kantor', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['kantor_polres', 'kantor_polsek']);
            $table->string('polsek_nama')->nullable();
            $table->string('nama');
            $table->decimal('luas_bangunan', 10, 2);
            $table->string('bangunan_di_atas');
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['kategori', 'polsek_nama']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kantor');
    }
};