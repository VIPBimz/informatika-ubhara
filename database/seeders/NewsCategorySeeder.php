<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Berita Laboratorium',
            'Event & Workshop',
            'Prestasi Mahasiswa',
            'Pengumuman Akademik',
        ];

        foreach ($categories as $nama) {
            NewsCategory::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama' => $nama,
                    'slug' => Str::slug($nama),
                ]
            );
        }
    }
}
