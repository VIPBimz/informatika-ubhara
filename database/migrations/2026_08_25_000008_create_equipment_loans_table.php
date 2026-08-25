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
        Schema::create('equipment_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipments')->cascadeOnDelete();
            $table->string('nama_peminjam', 150);
            $table->string('nim', 20);
            $table->string('no_wa', 20);
            $table->integer('jumlah_unit');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_rencana_kembali');
            $table->date('tanggal_kembali_aktual')->nullable();
            $table->text('keperluan');
            $table->boolean('setuju_sop')->default(false);
            $table->enum('status', [
                'pending',
                'approved',
                'dipinjam',
                'dikembalikan',
                'terlambat',
                'ditolak',
            ])->default('pending');
            $table->text('catatan_kondisi_kembali')->nullable();
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_loans');
    }
};
