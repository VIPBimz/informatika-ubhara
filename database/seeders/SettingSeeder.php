<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'jumlah_mahasiswa_aktif', 'value' => '450+'],
            ['key' => 'jumlah_ruang_lab', 'value' => '4'],
            ['key' => 'jumlah_aslab', 'value' => '16'],
            ['key' => 'jumlah_inventaris', 'value' => '120+'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/himatika_ubhara'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@himatikaubhara'],
            ['key' => 'github_url', 'value' => 'https://github.com/himatika-ubhara'],
            ['key' => 'email_kontak', 'value' => 'lab.informatika@ubhara.ac.id'],
            ['key' => 'alamat_lab', 'value' => 'Gedung Laboratorium Komputer Lt. 3, Universitas Bhayangkara Surabaya'],
            ['key' => 'telepon_kontak', 'value' => '+62 31 8286187'],
            ['key' => 'nama_situs', 'value' => 'Portal Lab & HIMATIKA Teknik Informatika UBHARA'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
