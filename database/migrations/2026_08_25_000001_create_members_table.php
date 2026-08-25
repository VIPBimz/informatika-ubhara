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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama', 150);
            $table->string('nim_nidn', 50)->nullable();
            $table->string('foto')->nullable();
            $table->enum('kategori', [
                'dosen',
                'aslab',
                'himatika',
            ]);
            $table->string('jabatan', 150);
            $table->string('divisi_keahlian', 150)->nullable();
            $table->string('angkatan', 10)->nullable();
            $table->enum('status_kepengurusan', ['aktif', 'purna'])->default('aktif');
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('email_kontak')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_published')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
