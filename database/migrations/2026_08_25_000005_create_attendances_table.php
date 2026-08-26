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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->string('nama', 150);
            $table->string('tujuan', 255);
            $table->foreignId('lab_id')->nullable()->constrained('labs')->nullOnDelete();
            $table->date('tanggal')->index();
            $table->time('jam_masuk');
            $table->timestamps();

            $table->index(['tanggal', 'nim']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
