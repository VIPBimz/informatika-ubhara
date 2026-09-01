<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 30)->default('user')->after('password');
        });

        // Set default roles for existing users
        DB::table('users')->where('email', 'admin@ubhara.ac.id')->update(['role' => 'superadmin']);
        DB::table('users')->where(function ($query) {
            $query->where('email', 'like', 'dosen%')
                  ->orWhere('email', 'like', 'fardanto%');
        })->update(['role' => 'dosen']);
        DB::table('users')->where('email', 'like', 'aslab%')->update(['role' => 'aslab']);
        DB::table('users')->where(function ($query) {
            $query->where('email', 'like', 'kominfo%')
                  ->orWhere('email', 'like', 'himatika%');
        })->update(['role' => 'himatika']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
