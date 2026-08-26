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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('equipment_categories')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->string('model_seri', 150)->nullable();
            $table->text('spesifikasi')->nullable();
            $table->enum('kondisi', ['sangat_baik', 'baik', 'perlu_perbaikan'])->default('sangat_baik');
            $table->string('foto')->nullable();
            $table->integer('stok_total')->default(0);
            $table->integer('stok_tersedia')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
