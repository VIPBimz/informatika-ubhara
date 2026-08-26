<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Praktikum Lab',
            'Workshop & Bootcamp',
            'Informatika Fest & Lomba',
            'Pengabdian Masyarakat',
            'Pelantikan & Rapat Kerja',
        ];

        foreach ($categories as $nama) {
            GalleryCategory::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama' => $nama,
                    'slug' => Str::slug($nama),
                ]
            );
        }
    }
}
