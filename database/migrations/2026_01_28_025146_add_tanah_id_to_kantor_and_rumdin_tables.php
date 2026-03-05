<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom tanah_id ke tabel kantor
        Schema::table('kantor', function (Blueprint $table) {
            $table->unsignedBigInteger('tanah_id')->nullable()->after('id');
            
            // Foreign key ke tabel tanah
            $table->foreign('tanah_id')
                  ->references('id')
                  ->on('tanah')
                  ->onDelete('set null');
        });

        // Tambah kolom tanah_id ke tabel rumdin
        Schema::table('rumdin', function (Blueprint $table) {
            $table->unsignedBigInteger('tanah_id')->nullable()->after('id');
            
            // Foreign key ke tabel tanah
            $table->foreign('tanah_id')
                  ->references('id')
                  ->on('tanah')
                  ->onDelete('set null');
        });

        // Tambah kolom tanah_id ke tabel barak
        Schema::table('barak', function (Blueprint $table) {
            $table->unsignedBigInteger('tanah_id')->nullable()->after('id');
            
            // Foreign key ke tabel tanah
            $table->foreign('tanah_id')
                  ->references('id')
                  ->on('tanah')
                  ->onDelete('set null');
        });

        // Tambah kolom tanah_id ke tabel garasi
        Schema::table('garasi', function (Blueprint $table) {
            $table->unsignedBigInteger('tanah_id')->nullable()->after('id');
            
            // Foreign key ke tabel tanah
            $table->foreign('tanah_id')
                  ->references('id')
                  ->on('tanah')
                  ->onDelete('set null');
        });

        // Tambah kolom tanah_id ke tabel mushola
        Schema::table('mushola', function (Blueprint $table) {
            $table->unsignedBigInteger('tanah_id')->nullable()->after('id');
            
            // Foreign key ke tabel tanah
            $table->foreign('tanah_id')
                  ->references('id')
                  ->on('tanah')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kantor', function (Blueprint $table) {
            $table->dropForeign(['tanah_id']);
            $table->dropColumn('tanah_id');
        });

        Schema::table('rumdin', function (Blueprint $table) {
            $table->dropForeign(['tanah_id']);
            $table->dropColumn('tanah_id');
        });

        Schema::table('barak', function (Blueprint $table) {
            $table->dropForeign(['tanah_id']);
            $table->dropColumn('tanah_id');
        });

        Schema::table('garasi', function (Blueprint $table) {
            $table->dropForeign(['tanah_id']);
            $table->dropColumn('tanah_id');
        });

        Schema::table('mushola', function (Blueprint $table) {
            $table->dropForeign(['tanah_id']);
            $table->dropColumn('tanah_id');
        });
    }
};