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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('lokasi');

            // tambah relasi ke tabel lokasi
            $table->foreignId('lokasi_id')
                  ->after('kategori_id')
                  ->constrained('lokasi')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
                // hapus foreign key & kolom lokasi_id
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn('lokasi_id');

            // kembalikan kolom lokasi (string)
            $table->string('lokasi')->after('kategori_id');
        });
    }
};