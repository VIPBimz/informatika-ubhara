<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@ubhara.ac.id'],
            [
                'name' => 'Super Admin Lab & HIMATIKA',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPERADMIN,
                'phone' => '081234567890',
                'is_active' => true,
            ]
        );

        // 2. Dosen Pembina / Kepala Lab
        $dosen = User::updateOrCreate(
            ['email' => 'dosen.lab@ubhara.ac.id'],
            [
                'name' => 'Dr. Ir. Dosen Pembina, M.Kom.',
                'password' => Hash::make('password'),
                'role' => User::ROLE_DOSEN,
                'nip_nidn' => '0712345678',
                'phone' => '081234567891',
                'is_active' => true,
            ]
        );

        Member::updateOrCreate(
            ['nim_nidn' => '0712345678'],
            [
                'user_id' => $dosen->id,
                'nama' => 'Dr. Ir. Dosen Pembina, M.Kom.',
                'nim_nidn' => '0712345678',
                'kategori' => 'dosen',
                'jabatan' => 'Kepala Laboratorium Teknik Informatika',
                'divisi_keahlian' => 'Artificial Intelligence & Software Engineering',
                'email_kontak' => 'dosen.lab@ubhara.ac.id',
                'urutan' => 1,
                'is_published' => true,
            ]
        );

        // 3. Koordinator Aslab
        $aslab = User::updateOrCreate(
            ['email' => 'aslab@ubhara.ac.id'],
            [
                'name' => 'Koordinator Asisten Lab',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ASLAB,
                'nip_nidn' => '2112001',
                'phone' => '081234567892',
                'is_active' => true,
            ]
        );

        Member::updateOrCreate(
            ['nim_nidn' => '2112001'],
            [
                'user_id' => $aslab->id,
                'nama' => 'Koordinator Asisten Lab',
                'nim_nidn' => '2112001',
                'kategori' => 'aslab',
                'jabatan' => 'Koordinator Asisten Laboratorium',
                'divisi_keahlian' => 'Network Architecture & Cloud',
                'angkatan' => '2022',
                'email_kontak' => 'aslab@ubhara.ac.id',
                'urutan' => 2,
                'is_published' => true,
            ]
        );

        // 4. Kominfo HIMATIKA
        $kominfo = User::updateOrCreate(
            ['email' => 'kominfo.himatika@ubhara.ac.id'],
            [
                'name' => 'Divisi Kominfo HIMATIKA',
                'password' => Hash::make('password'),
                'role' => User::ROLE_HIMATIKA,
                'nip_nidn' => '2212005',
                'phone' => '081234567893',
                'is_active' => true,
            ]
        );

        Member::updateOrCreate(
            ['nim_nidn' => '2212005'],
            [
                'user_id' => $kominfo->id,
                'nama' => 'Pengurus Kominfo HIMATIKA',
                'nim_nidn' => '2212005',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Divisi Komunikasi & Informasi',
                'divisi_keahlian' => 'UI/UX Design & Content Production',
                'angkatan' => '2023',
                'email_kontak' => 'kominfo.himatika@ubhara.ac.id',
                'urutan' => 3,
                'is_published' => true,
            ]
        );
    }
}
