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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->cascadeOnDelete();
            $table->string('nama_pemohon', 150);
            $table->string('identitas_pemohon', 50); // NIM / NIDN
            $table->enum('jenis_pemohon', ['mahasiswa', 'dosen', 'organisasi']);
            $table->enum('keperluan', [
                'kuliah_pengganti',
                'seminar',
                'riset',
                'ujian_praktikum',
                'lainnya',
            ]);
            $table->integer('estimasi_peserta');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
