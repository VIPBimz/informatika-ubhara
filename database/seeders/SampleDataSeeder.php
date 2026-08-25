<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Booking;
use App\Models\DamageReport;
use App\Models\DamageReportLog;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\EquipmentLoan;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\GalleryAlbum;
use App\Models\GalleryCategory;
use App\Models\Lab;
use App\Models\Member;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();
        $aslabMember = Member::where('kategori', 'aslab')->first();
        $rplLab = Lab::where('kode', 'LAB-RPL')->first();
        $netLab = Lab::where('kode', 'LAB-NET')->first();
        $aiLab = Lab::where('kode', 'LAB-AI')->first();
        $iotLab = Lab::where('kode', 'LAB-IOT')->first();

        // 1. Equipments
        $catJaringan = EquipmentCategory::where('slug', 'jaringan-komputer')->first();
        $catIoT = EquipmentCategory::where('slug', 'iot-mikrokontroler')->first();
        $catVR = EquipmentCategory::where('slug', 'multimedia-vr')->first();
        $catTool = EquipmentCategory::where('slug', 'toolkit-perkakas')->first();

        $eq1 = Equipment::updateOrCreate(
            ['nama' => 'RouterBoard MikroTik RB750Gr3'],
            [
                'category_id' => $catJaringan?->id ?? 1,
                'model_seri' => 'RB750Gr3-hEX',
                'spesifikasi' => '5x Gigabit Ethernet, Dual Core 880MHz CPU, 256MB RAM, RouterOS v7.',
                'kondisi' => 'sangat_baik',
                'stok_total' => 10,
                'stok_tersedia' => 8,
                'status' => 'aktif',
            ]
        );

        $eq2 = Equipment::updateOrCreate(
            ['nama' => 'ESP32 NodeMCU WiFi & Bluetooth DevKit'],
            [
                'category_id' => $catIoT?->id ?? 2,
                'model_seri' => 'ESP-WROOM-32',
                'spesifikasi' => 'Micro-USB interface, Dual-Core 240MHz, 30 GPIO Pins, Free Breadboard.',
                'kondisi' => 'sangat_baik',
                'stok_total' => 25,
                'stok_tersedia' => 20,
                'status' => 'aktif',
            ]
        );

        $eq3 = Equipment::updateOrCreate(
            ['nama' => 'Meta Quest 2 VR Headset 128GB'],
            [
                'category_id' => $catVR?->id ?? 4,
                'model_seri' => 'MQ2-128-VR',
                'spesifikasi' => 'All-in-one VR headset, 2x Touch Controllers, Link Cable Type-C 5m.',
                'kondisi' => 'sangat_baik',
                'stok_total' => 3,
                'stok_tersedia' => 2,
                'status' => 'aktif',
            ]
        );

        $eq4 = Equipment::updateOrCreate(
            ['nama' => 'Crimping Tool RJ45 + Cable Tester Pro'],
            [
                'category_id' => $catTool?->id ?? 5,
                'model_seri' => 'TL-210C',
                'spesifikasi' => 'Tang crimping 8P8C/RJ45, pemotong kabel, tester LAN master & remote.',
                'kondisi' => 'baik',
                'stok_total' => 15,
                'stok_tersedia' => 12,
                'status' => 'aktif',
            ]
        );

        // 2. Equipment Loans
        EquipmentLoan::updateOrCreate(
            ['nim' => '2212015', 'equipment_id' => $eq1->id],
            [
                'nama_peminjam' => 'Ahmad Fauzi',
                'nim' => '2212015',
                'no_wa' => '081299887766',
                'jumlah_unit' => 2,
                'tanggal_pinjam' => now()->toDateString(),
                'tanggal_rencana_kembali' => now()->addDays(3)->toDateString(),
                'keperluan' => 'Praktikum Mandiri Jaringan Komputer & Konfigurasi VLAN Tugas Akhir',
                'setuju_sop' => true,
                'status' => 'pending',
            ]
        );

        EquipmentLoan::updateOrCreate(
            ['nim' => '2212030', 'equipment_id' => $eq3->id],
            [
                'nama_peminjam' => 'Nabila Putri',
                'nim' => '2212030',
                'no_wa' => '081344556677',
                'jumlah_unit' => 1,
                'tanggal_pinjam' => now()->subDays(2)->toDateString(),
                'tanggal_rencana_kembali' => now()->addDays(2)->toDateString(),
                'keperluan' => 'Pengujian Aplikasi Virtual Reality Pembelajaran Anatomi Tubuh',
                'setuju_sop' => true,
                'status' => 'dipinjam',
                'diproses_oleh' => $admin?->id,
            ]
        );

        // 3. Schedules
        $sch1 = Schedule::updateOrCreate(
            ['lab_id' => $rplLab?->id ?? 1, 'hari' => 'senin', 'sesi_ke' => 1],
            [
                'lab_id' => $rplLab?->id ?? 1,
                'hari' => 'senin',
                'sesi_ke' => 1,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'mata_kuliah' => 'Pemrograman Berorientasi Objek',
                'kelas' => 'IF-3A',
                'semester' => 'Ganjil 2026/2027',
                'dosen_pengampu' => 'Dr. Ir. Dosen Pembina, M.Kom.',
                'aslab_jaga_id' => $aslabMember?->id,
                'jumlah_mahasiswa' => 32,
                'status' => 'terjadwal',
                'created_by' => $admin?->id,
            ]
        );

        $sch2 = Schedule::updateOrCreate(
            ['lab_id' => $netLab?->id ?? 2, 'hari' => 'selasa', 'sesi_ke' => 2],
            [
                'lab_id' => $netLab?->id ?? 2,
                'hari' => 'selasa',
                'sesi_ke' => 2,
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'mata_kuliah' => null,
                'status' => 'tersedia',
                'created_by' => $admin?->id,
            ]
        );

        // 4. Bookings
        Booking::updateOrCreate(
            ['nama_pemohon' => 'Bima Arya', 'schedule_id' => $sch2->id],
            [
                'schedule_id' => $sch2->id,
                'nama_pemohon' => 'Bima Arya',
                'identitas_pemohon' => '2212001',
                'jenis_pemohon' => 'mahasiswa',
                'keperluan' => 'kuliah_pengganti',
                'estimasi_peserta' => 28,
                'status' => 'pending',
            ]
        );

        // 5. Damage Reports & Logs
        $dmg = DamageReport::updateOrCreate(
            ['nomor_tiket' => 'TCK-20260825-001'],
            [
                'lab_id' => $rplLab?->id ?? 1,
                'lokasi_fasilitas' => 'PC Client 04 (Baris Depan)',
                'kategori' => 'hardware',
                'nama_pelapor' => 'Rizky Pratama',
                'nim' => '2312044',
                'no_wa' => '081234567800',
                'deskripsi' => 'Monitor tidak menampilkan display (No Signal), kabel HDMI sudah dicoba ganti tetap blank.',
                'status' => 'investigasi',
                'ditangani_oleh' => $aslabMember?->id,
                'tanggal_lapor' => now()->subHours(3),
            ]
        );

        DamageReportLog::updateOrCreate(
            ['damage_report_id' => $dmg->id, 'status' => 'diterima'],
            [
                'damage_report_id' => $dmg->id,
                'status' => 'diterima',
                'catatan' => 'Laporan diterima oleh sistem tiket helpdesk.',
                'created_at' => now()->subHours(3),
            ]
        );

        DamageReportLog::updateOrCreate(
            ['damage_report_id' => $dmg->id, 'status' => 'investigasi'],
            [
                'damage_report_id' => $dmg->id,
                'status' => 'investigasi',
                'catatan' => 'Aslab sedang melakukan pengecekan GPU dan RAM PC Client 04.',
                'updated_by' => $admin?->id,
                'created_at' => now()->subHours(1),
            ]
        );

        // 6. Attendances
        Attendance::updateOrCreate(
            ['nim' => '2212001', 'tanggal' => now()->toDateString()],
            [
                'nim' => '2212001',
                'nama' => 'Bima Arya',
                'tujuan' => 'Riset Skripsi & Uji Coba Jaringan',
                'lab_id' => $netLab?->id ?? 2,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => '08:30:00',
            ]
        );

        Attendance::updateOrCreate(
            ['nim' => '2212015', 'tanggal' => now()->toDateString()],
            [
                'nim' => '2212015',
                'nama' => 'Ahmad Fauzi',
                'tujuan' => 'Praktikum Mandiri Basis Data',
                'lab_id' => $rplLab?->id ?? 1,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => '09:15:00',
            ]
        );

        // 7. News & Events
        $newsCat = NewsCategory::first();
        if ($newsCat && $admin) {
            News::updateOrCreate(
                ['slug' => 'pembukaan-rekrutmen-asisten-laboratorium-2026'],
                [
                    'category_id' => $newsCat->id,
                    'judul' => 'Pembukaan Rekrutmen Asisten Laboratorium Informatika 2026',
                    'slug' => 'pembukaan-rekrutmen-asisten-laboratorium-2026',
                    'ringkasan' => 'Laboratorium Teknik Informatika UBHARA membuka kesempatan bagi mahasiswa aktif untuk bergabung sebagai Asisten Laboratorium periode 2026/2027.',
                    'konten' => '<p>Laboratorium Teknik Informatika membuka rekrutmen asisten lab untuk mata kuliah Pemrograman Web, Jaringan Komputer, Basis Data, dan Kecerdasan Buatan. Segera daftarkan diri Anda sebelum tanggal 30 September 2026.</p>',
                    'penulis_id' => $admin->id,
                    'is_featured' => true,
                    'status' => 'published',
                    'tanggal_terbit' => now()->toDateString(),
                    'views' => 142,
                ]
            );
        }

        $event = Event::updateOrCreate(
            ['judul' => 'Workshop Cyber Security: Ethical Hacking 101'],
            [
                'judul' => 'Workshop Cyber Security: Ethical Hacking 101',
                'deskripsi' => 'Belajar dasar penetrasi keamanan jaringan, vulnerability scanning, dan hardening server Linux bersama praktisi industri.',
                'tanggal_mulai' => now()->addDays(10)->setTime(9, 0),
                'tanggal_selesai' => now()->addDays(10)->setTime(15, 0),
                'lokasi_atau_link' => 'Lab Jaringan & Siber Lt. 3 / Hybrid Zoom',
                'kuota' => 50,
                'status' => 'published',
            ]
        );

        EventRegistration::updateOrCreate(
            ['event_id' => $event->id, 'email' => 'peserta1@gmail.com'],
            [
                'event_id' => $event->id,
                'nama' => 'Dwi Cahyo',
                'nim_nidn' => '2312088',
                'email' => 'peserta1@gmail.com',
                'no_wa' => '081234112233',
                'status' => 'terdaftar',
            ]
        );

        // 8. Gallery
        $galCat = GalleryCategory::first();
        if ($galCat) {
            GalleryAlbum::updateOrCreate(
                ['judul' => 'Dokumentasi Workshop AI & Machine Learning 2026'],
                [
                    'category_id' => $galCat->id,
                    'judul' => 'Dokumentasi Workshop AI & Machine Learning 2026',
                    'tanggal_kegiatan' => now()->subDays(15)->toDateString(),
                    'deskripsi' => 'Kegiatan workshop intensif penggunaan Python dan TensorFlow untuk Computer Vision.',
                ]
            );
        }

        // 9. Members (Dosen Pembina, Aslab, BPH & Divisi HIMATIKA)
        $membersData = [
            [
                'nama' => 'Budi Santoso',
                'nim_nidn' => '2212001',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Umum HIMATIKA',
                'divisi_keahlian' => 'Leadership & Project Management',
                'angkatan' => '2022',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/budi-santoso',
                'github_url' => 'https://github.com/budisantoso',
                'instagram_url' => 'https://instagram.com/budi_santoso',
                'email_kontak' => 'budi.santoso@mhs.ubhara.ac.id',
                'urutan' => 3,
                'is_published' => true,
            ],
            [
                'nama' => 'Siti Aminah, S.Kom.',
                'nim_nidn' => '2112004',
                'kategori' => 'aslab',
                'jabatan' => 'Wakil Koordinator Asisten Lab',
                'divisi_keahlian' => 'Database Systems & Cloud Computing',
                'angkatan' => '2021',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/siti-aminah',
                'github_url' => 'https://github.com/sitiaminah',
                'email_kontak' => 'siti.aminah@mhs.ubhara.ac.id',
                'urutan' => 4,
                'is_published' => true,
            ],
            [
                'nama' => 'Andi Wijaya',
                'nim_nidn' => '2212015',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Divisi Litbang & Ristek',
                'divisi_keahlian' => 'Fullstack Web & AI Research',
                'angkatan' => '2022',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/andiwijaya',
                'github_url' => 'https://github.com/andiwijaya',
                'instagram_url' => 'https://instagram.com/andi_wijaya',
                'email_kontak' => 'andi.wijaya@mhs.ubhara.ac.id',
                'urutan' => 5,
                'is_published' => true,
            ],
            [
                'nama' => 'Dinda Putri Lestari',
                'nim_nidn' => '2212022',
                'kategori' => 'aslab',
                'jabatan' => 'Asisten Lab Rekayasa Perangkat Lunak',
                'divisi_keahlian' => 'Mobile App Development (Flutter) & UI/UX',
                'angkatan' => '2022',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/dindaputri',
                'instagram_url' => 'https://instagram.com/dinda_putri',
                'email_kontak' => 'dinda.putri@mhs.ubhara.ac.id',
                'urutan' => 6,
                'is_published' => true,
            ],
            [
                'nama' => 'Maya Sari',
                'nim_nidn' => '2212035',
                'kategori' => 'himatika',
                'jabatan' => 'Bendahara Umum HIMATIKA',
                'divisi_keahlian' => 'Financial Planning & Sponsorship',
                'angkatan' => '2022',
                'status_kepengurusan' => 'aktif',
                'instagram_url' => 'https://instagram.com/mayasari',
                'email_kontak' => 'maya.sari@mhs.ubhara.ac.id',
                'urutan' => 7,
                'is_published' => true,
            ],
            [
                'nama' => 'Riko Maulana',
                'nim_nidn' => '2312010',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Divisi Kominfo',
                'divisi_keahlian' => 'Graphic Design, Branding & Video Editing',
                'angkatan' => '2023',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/rikomaulana',
                'instagram_url' => 'https://instagram.com/riko_maulana',
                'email_kontak' => 'riko.maulana@mhs.ubhara.ac.id',
                'urutan' => 8,
                'is_published' => true,
            ],
            [
                'nama' => 'Kevin Aprilio',
                'nim_nidn' => '2312040',
                'kategori' => 'aslab',
                'jabatan' => 'Asisten Lab Jaringan & Keamanan Siber',
                'divisi_keahlian' => 'Penetration Testing & Linux Server',
                'angkatan' => '2023',
                'status_kepengurusan' => 'aktif',
                'github_url' => 'https://github.com/kevinaprilio',
                'email_kontak' => 'kevin.aprilio@mhs.ubhara.ac.id',
                'urutan' => 9,
                'is_published' => true,
            ],
            [
                'nama' => 'Reza Fahlevi',
                'nim_nidn' => '2212055',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Divisi Humas & Eksternal',
                'divisi_keahlian' => 'Public Speaking & Media Relations',
                'angkatan' => '2022',
                'status_kepengurusan' => 'aktif',
                'linkedin_url' => 'https://linkedin.com/in/rezafahlevi',
                'email_kontak' => 'reza.fahlevi@mhs.ubhara.ac.id',
                'urutan' => 10,
                'is_published' => true,
            ],
            [
                'nama' => 'Bagus Ramadhan',
                'nim_nidn' => '2312018',
                'kategori' => 'himatika',
                'jabatan' => 'Ketua Divisi PSDM',
                'divisi_keahlian' => 'Talent Management & Human Resources',
                'angkatan' => '2023',
                'status_kepengurusan' => 'aktif',
                'instagram_url' => 'https://instagram.com/bagus_ramadhan',
                'email_kontak' => 'bagus.ramadhan@mhs.ubhara.ac.id',
                'urutan' => 11,
                'is_published' => true,
            ],
        ];

        foreach ($membersData as $data) {
            Member::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}
