<?php

namespace Database\Seeders;

use App\Models\EquipmentCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EquipmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Jaringan Komputer',
            'IoT & Mikrokontroler',
            'Komponen & Hardware',
            'Multimedia & VR',
            'Toolkit & Perkakas',
        ];

        foreach ($categories as $nama) {
            EquipmentCategory::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama' => $nama,
                    'slug' => Str::slug($nama),
                ]
            );
        }
    }
}
