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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('news_categories')->cascadeOnDelete();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->string('cover')->nullable();
            $table->string('ringkasan', 500);
            $table->longText('konten');
            $table->foreignId('penulis_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->date('tanggal_terbit')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
