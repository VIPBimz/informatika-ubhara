<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            LabSeeder::class,
            EquipmentCategorySeeder::class,
            NewsCategorySeeder::class,
            GalleryCategorySeeder::class,
            UserSeeder::class,
            SampleDataSeeder::class,
        ]);
    }
}
