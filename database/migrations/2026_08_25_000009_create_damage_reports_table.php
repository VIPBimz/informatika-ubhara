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
        Schema::create('damage_reports', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket', 30)->unique();
            $table->foreignId('lab_id')->constrained('labs')->cascadeOnDelete();
            $table->string('lokasi_fasilitas', 100);
            $table->enum('kategori', ['hardware', 'software', 'jaringan', 'fasilitas']);
            $table->string('nama_pelapor', 150);
            $table->string('nim', 20);
            $table->string('no_wa', 20);
            $table->text('deskripsi');
            $table->string('foto_bukti')->nullable();
            $table->enum('status', ['diterima', 'investigasi', 'diperbaiki', 'selesai'])->default('diterima');
            $table->foreignId('ditangani_oleh')->nullable()->constrained('members')->nullOnDelete();
            $table->timestamp('tanggal_lapor')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_reports');
    }
};
