<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = [
            [
                'kode' => 'LAB-RPL',
                'nama' => 'Lab Rekayasa Perangkat Lunak & Basis Data',
                'kapasitas' => 35,
                'deskripsi' => 'Laboratorium untuk praktikum pemrograman, pengembangan sistem web & mobile, serta basis data relasional/NoSQL.',
                'status' => 'aktif',
            ],
            [
                'kode' => 'LAB-NET',
                'nama' => 'Lab Jaringan Komputer & Keamanan Siber',
                'kapasitas' => 35,
                'deskripsi' => 'Laboratorium untuk praktikum routing, switching, sistem operasi jaringan, simulasi cyber security, dan forensic digital.',
                'status' => 'aktif',
            ],
            [
                'kode' => 'LAB-AI',
                'nama' => 'Lab Kecerdasan Buatan & Multimedia',
                'kapasitas' => 30,
                'deskripsi' => 'Laboratorium khusus riset dan praktikum Machine Learning, Computer Vision, Deep Learning, Game Development, dan VR/AR.',
                'status' => 'aktif',
            ],
            [
                'kode' => 'LAB-IOT',
                'nama' => 'Lab Internet of Things & Embedded System',
                'kapasitas' => 25,
                'deskripsi' => 'Laboratorium perancangan mikrokontroler (Arduino, ESP32, Raspberry Pi), sensor, aktuator, dan smart automation.',
                'status' => 'aktif',
            ],
        ];

        foreach ($labs as $lab) {
            Lab::updateOrCreate(
                ['kode' => $lab['kode']],
                $lab
            );
        }
    }
}
