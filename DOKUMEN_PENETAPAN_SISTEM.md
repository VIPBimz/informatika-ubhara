# Dokumen Penetapan Sistem
## Portal Laboratorium & HIMATIKA Teknik Informatika — Universitas Bhayangkara Surabaya

**Stack Teknologi:** Laravel 12 (Backend/CMS) · MySQL (Database) · Blade/Livewire atau API+SPA (opsional) · Spatie Laravel-Permission (Role & Hak Akses) · Filament PHP (disarankan untuk Admin Panel)

**Referensi:** `REKAP_SISTEM.md` (rekap 8 halaman statis: Beranda, Absensi, Jadwal Lab, Pinjam Alat, Lapor Kerusakan, Anggota, Berita, Galeri)

---

## 1. Ringkasan Eksekutif

Dokumen ini menetapkan arsitektur sistem backend (CMS) dan skema database untuk mengubah 8 halaman statis pada rekap menjadi aplikasi web dinamis berbasis Laravel 12. Sistem dibagi menjadi dua sisi:

1. **Sisi Publik (Front Office)** — dapat diakses oleh mahasiswa/tamu tanpa login penuh, khusus untuk aksi transaksional ringan (presensi, booking ruang, pinjam alat, lapor kerusakan) yang cukup diverifikasi dengan NIM.
2. **Sisi CMS/Admin (Back Office)** — memerlukan autentikasi & role, digunakan oleh Aslab, Kepala Lab, Dosen Pembina, dan Pengurus HIMATIKA (Kominfo) untuk mengelola seluruh data dan konten.

Setiap modul pada rekap (Absensi, Jadwal Lab, Pinjam Alat, Lapor Kerusakan, Anggota, Berita, Galeri) dipetakan menjadi entitas database, alur kerja (workflow) approval, dan menu CMS tersendiri.

---

## 2. Aktor & Peran (Role) Sistem

| Role | Deskripsi | Akses Utama |
|---|---|---|
| **Guest / Mahasiswa** | Pengunjung umum & mahasiswa aktif | Isi presensi, ajukan booking ruang, ajukan pinjam alat, kirim laporan kerusakan, lihat berita/galeri/anggota (tanpa login) |
| **Aslab (Asisten Lab)** | Penjaga & pengelola harian lab | Verifikasi peminjaman alat, tangani tiket kerusakan, kelola jadwal jaga, lihat presensi |
| **Kepala Lab / Dosen Pembina** | Penanggung jawab akademik lab | Approve booking ruang, kelola jadwal praktikum, kelola inventaris, lihat laporan & statistik |
| **Pengurus HIMATIKA (Kominfo)** | Tim publikasi & konten | Kelola berita, agenda/event, galeri, direktori pengurus |
| **BPH / Ketua Umum HIMATIKA** | Pimpinan organisasi | Kelola struktur pengurus, approve konten sensitif |
| **Super Admin** | Administrator sistem | Kelola user, role, permission, master data, pengaturan situs |

> Catatan desain: Role di atas diimplementasikan dengan **Spatie Laravel-Permission** (`roles`, `permissions`, `model_has_roles`, `role_has_permissions`) agar hak akses granular dan mudah diperluas tanpa mengubah struktur tabel `users`.

---

## 3. Kebutuhan Fungsional per Modul

| Modul | Fitur Publik | Fitur CMS/Admin |
|---|---|---|
| **Beranda** | Statistik kilat, preview berita, profil lab & HIMATIKA | Kelola statistik (settings), kelola konten section |
| **Presensi Lab** | Form isi NIM/Nama/Tujuan, list realtime, search | Rekap presensi, export laporan, filter per tanggal/lab |
| **Jadwal Lab** | Lihat jadwal per ruang & hari, ajukan booking slot kosong | CRUD jadwal praktikum, approve/reject booking, kelola status ruang (maintenance) |
| **Pinjam Alat** | Katalog alat, filter kategori, ajukan peminjaman | CRUD inventaris & stok, approve/reject peminjaman, proses pengembalian, cek kondisi alat |
| **Lapor Kerusakan** | Form tiket + upload foto, lihat status alur | Kelola tiket (status: diterima → investigasi → diperbaiki → selesai), assign teknisi |
| **Anggota** | Direktori dosen/aslab/pengurus, filter divisi, search | CRUD data anggota, foto, jabatan, sosial media |
| **Berita & Agenda** | Baca berita, filter kategori, daftar event | CRUD berita (draft/publish), CRUD event, kelola pendaftaran event |
| **Galeri** | Lihat album/foto per kategori, lightbox | CRUD album & foto, kategori dokumentasi |

### Kebutuhan Non-Fungsional
- **Keamanan:** CSRF protection (bawaan Laravel), rate limiting untuk form publik (anti-spam), validasi file upload (mime & ukuran), hashing password (bcrypt/argon2).
- **Notifikasi:** Email (Laravel Notification + Mail) untuk update status tiket/peminjaman/booking; opsional integrasi WhatsApp Gateway (mis. Fonnte/WABlas) karena rekap mensyaratkan input nomor WA.
- **Audit Trail:** Log aktivitas admin (siapa approve/reject apa & kapan) via tabel `activity_logs` (bisa memakai package `spatie/laravel-activitylog`).
- **Storage:** File upload (foto bukti kerusakan, foto alat, foto anggota, galeri) disimpan di `storage/app/public` (disk `public`) dengan symlink, atau S3-compatible untuk produksi.
- **Performa:** Pagination pada semua listing (berita, galeri, anggota, tiket), eager loading relasi untuk hindari N+1 query, caching untuk data statistik beranda.
- **Skalabilitas Role:** Struktur role/permission fleksibel agar mudah menambah divisi HIMATIKA baru tanpa migrasi ulang skema.

---

## 4. Rancangan Skema Database (MySQL)

### 4.1 Gambaran Modul & Grup Tabel

```
[AUTH & USER]        users, roles, permissions, model_has_roles
[PROFIL/ANGGOTA]     members
[LAB & JADWAL]       labs, schedules, bookings
[PRESENSI]           attendances
[INVENTARIS]         equipment_categories, equipments, equipment_loans
[HELPDESK]           damage_reports, damage_report_logs
[KONTEN BERITA]      news_categories, news, events, event_registrations
[GALERI]             gallery_categories, gallery_albums, gallery_photos
[SISTEM]             settings, activity_logs, notifications
```

### 4.2 Detail Tabel

#### `users`
Akun untuk sisi CMS (Aslab, Dosen, Kominfo, Admin). Mahasiswa **tidak wajib** punya akun untuk transaksi publik.

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| name | varchar(150) | |
| email | varchar(150) unique | |
| password | varchar | hashed |
| nip_nidn | varchar(50) nullable | untuk dosen/staf |
| phone | varchar(20) nullable | |
| avatar | varchar nullable | path foto |
| is_active | boolean default true | |
| email_verified_at | timestamp nullable | |
| remember_token | varchar nullable | |
| timestamps | | created_at, updated_at |

Relasi: `users` `1—1` `members` (opsional, jika akun terhubung ke profil publik), `users` `m—n` `roles` (via Spatie).

#### `members` (Direktori Anggota — halaman `anggota.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| user_id | FK users nullable | jika anggota punya akun login |
| nama | varchar(150) | |
| nim_nidn | varchar(50) nullable | |
| foto | varchar nullable | |
| kategori | enum('dosen_pembina','aslab','bph_himatika','litbang','kominfo','psdm','humas') | dipakai untuk filter divisi |
| jabatan | varchar(150) | mis. "Kepala Laboratorium", "Ketua Umum" |
| divisi_keahlian | varchar(150) nullable | mis. "Fullstack Web", "Cyber Security" |
| angkatan | varchar(10) nullable | |
| status_kepengurusan | enum('aktif','purna') default 'aktif' | |
| linkedin_url, github_url, instagram_url | varchar nullable | |
| email_kontak | varchar nullable | |
| urutan | integer default 0 | untuk sorting tampilan |
| is_published | boolean default true | |
| timestamps | | |

#### `labs` (Master Ruangan)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| kode | varchar(20) unique | mis. "LAB-RPL" |
| nama | varchar(150) | "Lab RPL & Basis Data", "Lab Jaringan & Keamanan Siber", dst |
| kapasitas | integer | |
| deskripsi | text nullable | |
| foto | varchar nullable | |
| status | enum('aktif','maintenance') default 'aktif' | |
| timestamps | | |

#### `schedules` (Jadwal Praktikum — `jadwal_lab.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| lab_id | FK labs | |
| hari | enum('senin'..'sabtu') | |
| sesi_ke | tinyint | 1–5 |
| jam_mulai, jam_selesai | time | |
| mata_kuliah | varchar(150) nullable | null jika slot kosong |
| kelas | varchar(50) nullable | |
| semester | varchar(20) nullable | |
| dosen_pengampu | varchar(150) nullable | |
| aslab_jaga_id | FK members nullable | |
| kapasitas_peserta | integer nullable | |
| jumlah_mahasiswa | integer nullable | |
| status | enum('terjadwal','tersedia','maintenance') default 'tersedia' | menentukan warna badge |
| created_by | FK users | |
| timestamps | | |

> Slot yang `status = 'tersedia'` inilah yang menampilkan tombol **"Booking Slot"** di frontend.

#### `bookings` (Pengajuan Reservasi Ruangan)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| schedule_id | FK schedules | slot yang diajukan |
| nama_pemohon | varchar(150) | |
| identitas_pemohon | varchar(50) | NIM/NIDN |
| jenis_pemohon | enum('mahasiswa','dosen','organisasi') | |
| keperluan | enum('kuliah_pengganti','seminar','riset','ujian_praktikum','lainnya') | |
| estimasi_peserta | integer | |
| status | enum('pending','approved','rejected') default 'pending' | |
| catatan_admin | text nullable | alasan reject / catatan approve |
| approved_by | FK users nullable | |
| approved_at | timestamp nullable | |
| timestamps | | |

#### `attendances` (Presensi — `absensi.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| nim | varchar(20) | |
| nama | varchar(150) | |
| tujuan | varchar(255) | mis. "Praktikum Pemrograman Web" |
| lab_id | FK labs nullable | opsional jika ingin per-ruang |
| tanggal | date | index, untuk filter "hari ini" |
| jam_masuk | time | |
| timestamps | created_at saja cukup | |

Index gabungan `(tanggal, nim)` untuk pencarian cepat & mencegah duplikasi absen ganda dalam satu hari bila diperlukan.

#### `equipment_categories` (Kategori Alat)

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| nama | varchar(100) — "Jaringan Komputer", "IoT & Mikrokontroler", "Komponen & Hardware", "Multimedia & VR", "Toolkit & Perkakas" |
| slug | varchar(100) unique |

#### `equipments` (Inventaris Alat — `pinjam_alat.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| category_id | FK equipment_categories | |
| nama | varchar(150) | |
| model_seri | varchar(150) nullable | mis. "MikroTik RB750Gr3" |
| spesifikasi | text nullable | |
| kondisi | enum('sangat_baik','baik','perlu_perbaikan') default 'sangat_baik' | |
| foto | varchar nullable | |
| stok_total | integer | |
| stok_tersedia | integer | dikurangi otomatis saat loan disetujui, ditambah saat dikembalikan |
| status | enum('aktif','nonaktif') default 'aktif' | |
| timestamps | | |

#### `equipment_loans` (Peminjaman Alat)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| equipment_id | FK equipments | |
| nama_peminjam | varchar(150) | |
| nim | varchar(20) | |
| no_wa | varchar(20) | |
| jumlah_unit | integer | ≤ stok_tersedia saat pengajuan |
| tanggal_pinjam | date | |
| tanggal_rencana_kembali | date | |
| tanggal_kembali_aktual | date nullable | |
| keperluan | text | Praktikum/TA/Lomba |
| setuju_sop | boolean | checkbox persetujuan |
| status | enum('pending','approved','dipinjam','dikembalikan','terlambat','ditolak') default 'pending' | |
| catatan_kondisi_kembali | text nullable | diisi Aslab saat penerimaan alat kembali |
| diproses_oleh | FK users nullable | |
| timestamps | | |

> **Aturan bisnis:** saat `status` berubah `pending → approved`, sistem mengurangi `equipments.stok_tersedia` sejumlah `jumlah_unit` (via Model Observer/Event Laravel). Saat `status → dikembalikan`, stok dikembalikan.

#### `damage_reports` (Tiket Kerusakan — `lapor.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| nomor_tiket | varchar(30) unique | auto-generate, mis. `TCK-20260824-001` |
| lab_id | FK labs | |
| lokasi_fasilitas | varchar(100) | mis. "PC-04", "Switch Rack 2" |
| kategori | enum('hardware','software','jaringan','fasilitas') | |
| nama_pelapor | varchar(150) | |
| nim | varchar(20) | |
| no_wa | varchar(20) | |
| deskripsi | text | |
| foto_bukti | varchar nullable | |
| status | enum('diterima','investigasi','diperbaiki','selesai') default 'diterima' | |
| ditangani_oleh | FK members nullable | Aslab/teknisi |
| tanggal_lapor | timestamp | |
| tanggal_selesai | timestamp nullable | |
| timestamps | | |

#### `damage_report_logs` (Histori Status Tiket)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| damage_report_id | FK damage_reports | |
| status | varchar(30) | snapshot status saat itu |
| catatan | text nullable | |
| updated_by | FK users nullable | |
| created_at | timestamp | |

> Tabel log ini merepresentasikan **4 tahap alur** (Diterima → Investigasi → Perbaikan → Selesai) sebagai riwayat, sehingga progres tiket bisa ditampilkan sebagai timeline di frontend.

#### `news_categories`

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| nama | "Berita Laboratorium", "Event & Workshop", "Prestasi Mahasiswa", "Pengumuman Akademik" |
| slug | unique |

#### `news` (Berita — `berita.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| category_id | FK news_categories | |
| judul | varchar(255) | |
| slug | varchar(255) unique | |
| cover | varchar nullable | |
| ringkasan | varchar(500) | untuk preview card |
| konten | longtext | rich text (WYSIWYG) |
| penulis_id | FK users | |
| is_featured | boolean default false | untuk "Top Featured News" |
| status | enum('draft','published') default 'draft' | |
| tanggal_terbit | date nullable | |
| views | integer default 0 | |
| timestamps | | |

#### `events` (Agenda — sidebar "Upcoming Events")

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| judul | varchar(255) | Workshop/Seminar/Informatics Championship/Sertifikasi |
| poster | varchar nullable | |
| deskripsi | text nullable | |
| tanggal_mulai, tanggal_selesai | datetime | |
| lokasi_atau_link | varchar(255) | ruang fisik / link Zoom |
| kuota | integer nullable | |
| status | enum('draft','published','selesai') default 'draft' | |
| timestamps | | |

#### `event_registrations`

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| event_id | FK events |
| nama | varchar(150) |
| nim_nidn | varchar(50) |
| email | varchar(150) |
| no_wa | varchar(20) |
| status | enum('terdaftar','hadir','batal') default 'terdaftar' |
| timestamps | |

#### `gallery_categories`

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| nama | "Praktikum Lab", "Workshop & Bootcamp", "Informatika Fest & Lomba", "Pengabdian Masyarakat", "Pelantikan & Rapat Kerja" |
| slug | unique |

#### `gallery_albums` (`galeri.html`)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| category_id | FK gallery_categories | |
| judul | varchar(255) | |
| tanggal_kegiatan | date | |
| deskripsi | text nullable | |
| cover | varchar nullable | |
| timestamps | | |

#### `gallery_photos`

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| album_id | FK gallery_albums |
| foto | varchar |
| keterangan | varchar(255) nullable |
| urutan | integer default 0 |
| timestamps | |

#### `settings` (Statistik Kilat Beranda & Pengaturan Umum)

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| key | varchar(100) unique | mis. `jumlah_mahasiswa_aktif`, `jumlah_ruang_lab`, `jumlah_aslab`, `jumlah_inventaris`, `instagram_url`, `youtube_url`, `email_kontak` |
| value | text | |
| timestamps | | |

#### `activity_logs` (Audit Trail — opsional, atau pakai package Spatie)

| Kolom | Tipe |
|---|---|
| id | bigint PK |
| user_id | FK users |
| aksi | varchar(150) — mis. "approve_booking", "update_stok_alat" |
| model_type, model_id | polymorphic reference |
| deskripsi | text nullable |
| created_at | timestamp |

### 4.3 Ringkasan Relasi Antar Tabel

```
users        1───n  news
users        1───n  activity_logs
users        1───1  members (opsional)

labs         1───n  schedules
schedules    1───n  bookings
labs         1───n  attendances (opsional)
labs         1───n  damage_reports

members      1───n  schedules (sebagai aslab_jaga)
members      1───n  damage_reports (sebagai penanggung jawab)

equipment_categories  1───n  equipments
equipments             1───n  equipment_loans

news_categories  1───n  news
gallery_categories 1───n  gallery_albums
gallery_albums   1───n  gallery_photos
events           1───n  event_registrations

damage_reports   1───n  damage_report_logs
```

---

## 5. Rancangan User Flow

### 5.1 Flow Presensi Mahasiswa (Guest)
```
Buka absensi.html → Isi NIM, Nama, Tujuan → Klik "Simpan Absensi"
   → POST /attendances (validasi NIM & tujuan wajib)
   → Simpan ke tabel attendances (tanggal = hari ini)
   → Response AJAX sukses → Toast Notification muncul
   → List "Absen Hari Ini" refresh realtime (via Livewire/AJAX polling)
```

### 5.2 Flow Booking Ruangan
```
Mahasiswa/Dosen pilih ruang & hari → sistem tampilkan sesi (status: terisi/tersedia/maintenance)
   → Klik "Booking Slot" pada sesi berstatus tersedia
   → Modal form: nama, identitas, keperluan, estimasi peserta
   → Submit → INSERT bookings (status = pending)
   → [CMS] Kepala Lab/Aslab melihat daftar pending di dashboard
   → Approve → schedules.status diupdate jadi 'terjadwal' + notifikasi email/WA ke pemohon
   → Reject → catatan_admin diisi + notifikasi ke pemohon
```

### 5.3 Flow Peminjaman Alat
```
Mahasiswa cari/filter alat → cek stok_tersedia > 0 → klik "Pinjam Alat"
   → Modal form: identitas, jumlah unit (≤ stok), tanggal pinjam & rencana kembali, keperluan, centang SOP
   → Submit → INSERT equipment_loans (status = pending)
   → [CMS] Aslab verifikasi pengajuan
        → Approve → status = approved, stok_tersedia -= jumlah_unit, notifikasi ke peminjam
        → Reject → status = ditolak + alasan
   → Mahasiswa ambil alat di lab → Aslab set status = dipinjam
   → Saat pengembalian → Aslab cek kondisi, isi catatan_kondisi_kembali
        → status = dikembalikan, stok_tersedia += jumlah_unit
   → Jika tanggal_rencana_kembali terlewati & belum kembali → job scheduler ubah status = terlambat + notifikasi reminder
```

### 5.4 Flow Lapor Kerusakan
```
Pelapor isi form (ruang, lokasi fasilitas, kategori, identitas, deskripsi, upload foto)
   → Submit → INSERT damage_reports (status = diterima, nomor_tiket auto-generate)
   → INSERT damage_report_logs (status = diterima)
   → Notifikasi masuk ke dashboard Aslab/Teknisi
   → Aslab update status → investigasi → diperbaiki → selesai
        (setiap perubahan status → INSERT damage_report_logs baru + notifikasi WA/email ke pelapor)
   → Pelapor dapat cek progres tiket via nomor_tiket (halaman "Cek Status Laporan")
```

### 5.5 Flow Manajemen Konten (Berita/Galeri/Anggota) oleh Kominfo
```
Login CMS (role: pengurus_himatika/kominfo)
   → Menu Berita → Buat Baru → isi judul, kategori, cover, konten (WYSIWYG) → simpan sebagai draft
   → Review oleh BPH/Ketua Umum (opsional approval) → publish (status = published, tanggal_terbit terisi)
   → Tampil otomatis di berita.html & preview beranda

   → Menu Galeri → Buat Album (kategori + tanggal kegiatan) → Upload multiple foto
   → Menu Anggota → Tambah/Edit profil, atur kategori divisi & urutan tampilan
```

### 5.6 Flow Login & Otorisasi CMS
```
Admin/Aslab/Dosen/Kominfo akses /admin/login
   → Autentikasi (Laravel Breeze/Fortify + Spatie Permission)
   → Redirect ke dashboard sesuai role (menu ditampilkan berdasarkan permission)
   → Middleware 'role:aslab|kepala_lab|kominfo|super_admin' membatasi akses tiap route CMS
```

---

## 6. Rancangan Backend CMS

### 6.1 Rekomendasi Arsitektur
- **Laravel 12** sebagai backend inti (routing, Eloquent ORM, Job Queue, Notification).
- **Filament PHP (v3/v4 kompatibel Laravel 12)** direkomendasikan sebagai panel admin siap pakai — mempercepat pembuatan CRUD, resource, widget statistik, dan filter tanpa membangun UI admin dari nol.
- **Spatie Laravel-Permission** untuk role & permission granular per menu/aksi.
- **Livewire** (bawaan ekosistem Filament) untuk komponen interaktif publik seperti list presensi realtime & search tanpa reload.
- **Laravel Sanctum** apabila frontend publik dipisah sebagai SPA (Vue/React) yang mengonsumsi REST API; jika memakai Blade+Livewire penuh, Sanctum tidak wajib.
- **Queue + Laravel Notification** untuk pengiriman email/WA asinkron (approve/reject, update tiket) agar tidak memblokir proses request.
- **Laravel Scheduler** untuk job harian: cek keterlambatan pengembalian alat, reset counter presensi harian, dsb.

### 6.2 Struktur Menu CMS (berdasarkan Role)

| Menu | Super Admin | Kepala Lab | Aslab | Kominfo HIMATIKA |
|---|:---:|:---:|:---:|:---:|
| Dashboard & Statistik | ✅ | ✅ | ✅ | ✅ |
| Manajemen User & Role | ✅ | – | – | – |
| Data Anggota/Personalia | ✅ | ✅ | – | ✅ |
| Master Ruang Lab | ✅ | ✅ | – | – |
| Jadwal Praktikum | ✅ | ✅ | Lihat | – |
| Persetujuan Booking Ruang | ✅ | ✅ | Lihat | – |
| Rekap Presensi | ✅ | ✅ | ✅ | – |
| Master Inventaris & Kategori | ✅ | ✅ | ✅ | – |
| Persetujuan Peminjaman Alat | ✅ | ✅ | ✅ | – |
| Tiket Kerusakan (Helpdesk) | ✅ | ✅ | ✅ | – |
| Berita & Kategori | ✅ | – | – | ✅ |
| Agenda/Event & Pendaftar | ✅ | – | – | ✅ |
| Galeri & Album | ✅ | – | – | ✅ |
| Pengaturan Situs (settings) | ✅ | – | – | – |
| Log Aktivitas | ✅ | Lihat | – | – |

### 6.3 Dashboard & Widget Statistik (contoh)
- Card: Total Presensi Hari Ini, Booking Pending, Peminjaman Pending, Tiket Aktif.
- Grafik: Tren presensi mingguan, alat paling sering dipinjam, kategori kerusakan terbanyak.
- Tabel ringkas: 5 tiket terbaru, 5 booking pending, alat dengan stok menipis.

### 6.4 Rancangan Rute Utama (Ringkas)

**Publik (Web/Livewire):**
```
GET  /                         Beranda
GET  /absensi                  Form + list presensi
POST /absensi                  Simpan presensi
GET  /jadwal-lab                Kalender jadwal per ruang
POST /jadwal-lab/{schedule}/booking   Ajukan booking
GET  /pinjam-alat               Katalog alat
POST /pinjam-alat/{equipment}/pinjam  Ajukan peminjaman
GET  /lapor                     Form tiket kerusakan
POST /lapor                     Kirim tiket
GET  /lapor/cek/{nomor_tiket}   Cek status tiket
GET  /anggota                   Direktori anggota
GET  /berita, /berita/{slug}    Daftar & detail berita
GET  /agenda/{event}/daftar     Form registrasi event
GET  /galeri                    Galeri album & foto
```

**CMS/Admin (prefix `/admin`, middleware `auth`, `role:*`):**
```
/admin/dashboard
/admin/users, /admin/roles
/admin/members
/admin/labs, /admin/schedules
/admin/bookings                (approve/reject)
/admin/attendances             (rekap & export)
/admin/equipment-categories, /admin/equipments
/admin/equipment-loans         (approve/reject/return)
/admin/damage-reports          (update status + log)
/admin/news-categories, /admin/news
/admin/events, /admin/events/{event}/registrations
/admin/gallery-categories, /admin/gallery-albums
/admin/settings
/admin/activity-logs
```

### 6.5 Business Logic Kunci (Laravel Implementation Notes)
- **Model Observer/Event** pada `EquipmentLoan` untuk otomatisasi update `stok_tersedia` saat status berubah (`approved` → kurangi, `dikembalikan` → tambah).
- **Form Request Validation** terpisah per aksi (`StoreAttendanceRequest`, `StoreBookingRequest`, `StoreEquipmentLoanRequest`, `StoreDamageReportRequest`) untuk menjaga controller tetap ramping.
- **Policy** per model (`BookingPolicy`, `EquipmentLoanPolicy`, `DamageReportPolicy`) untuk memastikan hanya role terkait yang bisa approve/reject/update status.
- **Notification Class** (`BookingStatusChanged`, `LoanStatusChanged`, `DamageReportStatusChanged`) diimplementasikan sebagai `ShouldQueue` dengan channel `mail` dan channel custom `whatsapp` (via HTTP client ke provider WA Gateway).
- **Scheduled Command** (`php artisan schedule:run`) — contoh: `loans:mark-overdue` (harian, tandai peminjaman terlambat), `attendances:reset-daily-counter` (opsional jika counter disimpan cache, bukan query langsung).
- **Slug otomatis** untuk `news` dan kategori memakai `str()->slug()` pada saat model `creating` event.
- **Soft Delete** disarankan pada `news`, `gallery_albums`, `members`, `equipments` agar data historis (mis. laporan lama yang mereferensikan alat) tidak rusak saat data dihapus.

---

## 7. Ringkasan Keputusan Teknis

| Aspek | Keputusan |
|---|---|
| Framework | Laravel 12 |
| Database | MySQL 8.x |
| Autentikasi CMS | Laravel Breeze/Fortify + Spatie Laravel-Permission |
| Panel Admin | Filament PHP |
| Interaktivitas Publik | Livewire (list realtime presensi, search filter tanpa reload) |
| Notifikasi | Laravel Notification (Mail + WhatsApp Gateway API), dijalankan via Queue |
| Upload File | Laravel Storage (disk `public`, symlink), validasi mime & ukuran |
| Autentikasi Publik | Tidak wajib login — verifikasi via NIM per transaksi |
| Audit | Spatie Laravel-Activitylog atau tabel `activity_logs` custom |
| Scheduler | Laravel Task Scheduling untuk job status terlambat/pengingat |

---

## 8. Langkah Implementasi Bertahap (Roadmap Disarankan)

1. **Fondasi:** Setup Laravel 12, migrasi tabel `users`, `roles/permissions`, `members`, `settings`.
2. **Modul Lab Inti:** `labs`, `schedules`, `bookings`, `attendances` + CMS approval booking.
3. **Modul Inventaris:** `equipment_categories`, `equipments`, `equipment_loans` + otomatisasi stok.
4. **Modul Helpdesk:** `damage_reports`, `damage_report_logs` + notifikasi status.
5. **Modul Konten:** `news_categories`, `news`, `events`, `event_registrations`, `gallery_*`.
6. **Penyempurnaan:** Dashboard statistik, activity log, export laporan (Excel/PDF), integrasi WA Gateway, optimasi performa (cache, index).

---

*Dokumen ini menjadi acuan pengembangan skema database dan struktur backend CMS. Detail lanjutan (ERD diagram visual, wireframe admin panel, API contract) dapat disusun sebagai dokumen turunan bila diperlukan.*
