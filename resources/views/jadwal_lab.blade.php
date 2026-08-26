<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Lab - Portal Informatika Ubhara</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Tailwind CSS Setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1E3A8A', 
                        accent: '#FBBF24',  
                        neutralBg: '#F3F4F6',
                        // Status colors for calendar
                        statusPraktikum: '#EF4444', // Red
                        statusRiset: '#10B981',     // Green
                        statusHima: '#3B82F6',      // Blue
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Styles */
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hero-pattern {
            background-color: #1E3A8A;
            background-image: radial-gradient(circle at top right, rgba(251, 191, 36, 0.1) 0%, transparent 40%),
                              radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
        }
        /* Mobile menu transition */
        #mobile-menu {
            transition: max-height 0.3s ease-in-out, opacity 0.25s ease-in-out, visibility 0.3s;
            max-height: 0;
            opacity: 0;
            visibility: hidden;
            overflow: hidden;
        }
        #mobile-menu.open {
            max-height: 85vh; 
            opacity: 1;
            visibility: visible;
        }
        
        /* Custom Scrollbar for the calendar to make it look clean */
        .calendar-scroll::-webkit-scrollbar {
            height: 8px;
        }
        .calendar-scroll::-webkit-scrollbar-track {
            background: #F3F4F6;
            border-radius: 8px;
        }
        .calendar-scroll::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 8px;
        }
        .calendar-scroll::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }
    </style>
</head>
<body class="font-sans bg-neutralBg text-gray-800 antialiased">

    <!-- Navigation -->
    <header class="fixed w-full top-0 z-50 glass-nav border-b border-gray-200 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-1.5 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('ubhara_logo.png') }}" alt="Logo Ubhara"
                            class="shadow-sm border border-gray-100 rounded-full w-9 h-9 sm:w-10 sm:h-10 object-cover"
                            title="Universitas Bhayangkara Surabaya">
                        <img src="{{ asset('logo_lab_if.png') }}" alt="Logo Lab"
                            class="shadow-sm border border-gray-100 rounded-full w-9 h-9 sm:w-10 sm:h-10 object-cover"
                            title="Laboratorium Teknik Informatika">
                        <img src="{{ asset('himatika_logo.png') }}" alt="Logo HIMA"
                            class="shadow-sm border border-gray-100 rounded-full w-9 h-9 sm:w-10 sm:h-10 object-cover"
                            title="HIMATIKA">
                    </a>
                    <div class="hidden sm:block ml-1">
                        <h1 class="font-bold text-xl text-primary leading-tight">Portal IF</h1>
                        <p class="text-xs text-gray-500 font-medium">Ubhara Surabaya</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-primary font-medium px-1 py-2 transition-colors">Beranda</a>
                    
                    <!-- Lab Dropdown -->
                    <div class="group relative">
                        <a href="{{ url('/#laboratorium') }}" class="text-primary font-semibold border-b-2 border-accent px-1 py-2 flex items-center gap-1 transition-colors">
                            Laboratorium <i class="ph ph-caret-down text-sm"></i>
                        </a>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('jadwal_lab') }}" class="block px-4 py-2 text-sm text-primary bg-blue-50 font-medium">Jadwal Lab</a>
                                <a href="{{ route('pinjam_alat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Peminjaman Alat</a>
                                <a href="{{ route('lapor') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Lapor Kerusakan</a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <a href="{{ url('/#himatika') }}" class="text-gray-600 hover:text-primary font-medium px-1 py-2 flex items-center gap-1 transition-colors">
                            HIMATIKA <i class="ph ph-caret-down text-sm"></i>
                        </a>
                         <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('berita') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Berita & Acara</a>
                                <a href="{{ route('galeri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('anggota') }}" class="text-gray-600 hover:text-primary font-medium px-1 py-2">Anggota</a>
                </nav>

                <!-- Action Buttons: Absensi & Login (Desktop) -->
                <div class="hidden md:flex items-center gap-2.5">
                    <a href="{{ route('absensi') }}"
                        class="flex items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm px-4 lg:px-5 py-2.5 rounded-lg font-medium text-white text-sm transition-colors">
                        <i class="text-lg ph ph-user-circle"></i>
                        Absensi
                    </a>
                    <a href="{{ url('/admin/login') }}"
                        class="flex items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm px-4 lg:px-5 py-2.5 rounded-lg font-medium text-white text-sm transition-colors"
                        title="Login CMS Portal">
                        <i class="text-lg ph ph-sign-in"></i>
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-primary hover:text-blue-900 focus:outline-none p-2">
                        <i class="ph ph-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="top-full right-0 left-0 absolute md:hidden bg-white shadow-xl border-gray-100 border-t">
            <div class="space-y-1 px-4 pt-3 pb-5 max-h-[calc(100vh-5rem)] overflow-y-auto">
                <a href="{{ route('beranda') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Beranda</a>
                <a href="{{ url('/#laboratorium') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Laboratorium</a>
                <a href="{{ url('/#himatika') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">HIMATIKA</a>
                <a href="{{ route('anggota') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Anggota</a>
                <a href="{{ route('berita') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Berita & Acara</a>
                <a href="{{ route('galeri') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Galeri</a>
                <a href="{{ route('jadwal_lab') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Jadwal Lab</a>
                <a href="{{ route('pinjam_alat') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Peminjaman Alat</a>
                <a href="{{ route('lapor') }}"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Lapor Kerusakan</a>
                <div class="flex gap-2.5 pt-2">
                    <a href="{{ route('absensi') }}"
                        class="flex flex-1 justify-center items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm py-2.5 rounded-lg font-medium text-white text-sm transition-colors">
                        <i class="text-lg ph ph-user-circle"></i>
                        Absensi
                    </a>
                    <a href="{{ url('/admin/login') }}"
                        class="flex flex-1 justify-center items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm py-2.5 rounded-lg font-medium text-white text-sm transition-colors">
                        <i class="text-lg ph ph-sign-in"></i>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Header (Hero) -->
    <section class="pt-28 pb-12 md:pt-32 md:pb-16 hero-pattern text-white relative overflow-hidden border-b-4 border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase border border-white/30 backdrop-blur-sm">Layanan Lab</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2">
                        Jadwal & Ruangan <span class="text-accent">Laboratorium</span>
                    </h1>
                    <p class="text-blue-100 max-w-2xl">
                        Pantau ketersediaan ruang lab untuk keperluan praktikum, riset tugas akhir, maupun kegiatan organisasi. Pastikan cek jadwal sebelum mengajukan peminjaman.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <button onclick="showBookingDialog('Ditentukan saat login', 'Ditentukan saat login')" class="inline-flex items-center justify-center gap-2 bg-accent text-primary px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 hover:-translate-y-0.5 transition-all w-full md:w-auto">
                        <i class="ph ph-calendar-plus text-xl"></i> Ajukan Peminjaman
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content: Schedule Section -->
    <section class="py-10 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Controls & Filters -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                
                <!-- Room Selector -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="w-10 h-10 bg-blue-50 text-primary rounded-lg flex items-center justify-center">
                        <i class="ph ph-door text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <label for="room-select" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pilih Ruangan</label>
                        <select id="room-select" class="block w-full border-none bg-transparent text-gray-800 font-bold text-lg focus:ring-0 cursor-pointer outline-none">
                            <option value="lab-komputer-a">Lab Komputer A (Lantai 2)</option>
                            <option value="lab-jaringan">Lab Jaringan & IoT (Lantai 2)</option>
                            <option value="lab-multimedia">Lab Multimedia (Lantai 3)</option>
                            <option value="ruang-rapat">Ruang Rapat HIMATIKA</option>
                        </select>
                    </div>
                </div>

                <!-- Date Navigator -->
                <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-600" title="Minggu Sebelumnya">
                        <i class="ph ph-caret-left text-xl"></i>
                    </button>
                    <div class="text-center">
                        <p class="font-bold text-gray-800" id="current-week">10 - 16 Agustus 2026</p>
                        <p class="text-xs text-gray-500">Minggu Ganjil</p>
                    </div>
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-600" title="Minggu Berikutnya">
                        <i class="ph ph-caret-right text-xl"></i>
                    </button>
                    <button class="ml-2 px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors hidden sm:block">
                        Hari Ini
                    </button>
                </div>
            </div>

            <!-- Table Header & Action -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 px-1 gap-4">
                <!-- Legend -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-statusPraktikum"></span>
                        <span class="text-sm text-gray-600 font-medium">Praktikum / Kuliah</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-statusRiset"></span>
                        <span class="text-sm text-gray-600 font-medium">Riset / TA</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-statusHima"></span>
                        <span class="text-sm text-gray-600 font-medium">HIMATIKA</span>
                    </div>
                </div>
                <!-- Action Button -->
                <button onclick="showBookingDialog('Ditentukan saat login', 'Ditentukan saat login')" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-900 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
                    <i class="ph ph-plus-circle text-lg"></i> Booking Ruangan
                </button>
            </div>

            <!-- List/Table Container -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="p-4 w-48">Hari, Tanggal</th>
                                <th class="p-4 w-36">Waktu</th>
                                <th class="p-4">Kegiatan</th>
                                <th class="p-4 w-40">Kategori</th>
                                <th class="p-4 w-48">Penanggung Jawab</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            
                            <!-- Data Row 1 (Praktikum) -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">Selasa, 11 Agt 2026</div>
                                    <div class="text-xs text-primary font-medium mt-0.5 bg-blue-50 inline-block px-2 py-0.5 rounded">Hari Ini</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-700 flex items-center gap-1.5 font-medium"><i class="ph ph-clock text-gray-400"></i> 08:00 - 10:00</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800">Praktikum Jaringan Komputer</div>
                                    <div class="text-gray-500 text-xs mt-0.5">Modul 1: Subnetting Dasar (Kelas 3A)</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 border border-red-100 px-2.5 py-1 rounded-md text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-statusPraktikum"></span> Praktikum
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-800 font-medium">Bpk. Andi, M.Kom</div>
                                    <div class="text-gray-500 text-xs">Dosen Pengampu</div>
                                </td>
                            </tr>
                            
                            <!-- Data Row 2 (Riset) -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">Selasa, 11 Agt 2026</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-700 flex items-center gap-1.5 font-medium"><i class="ph ph-clock text-gray-400"></i> 10:00 - 12:00</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800">Riset IoT Skripsi</div>
                                    <div class="text-gray-500 text-xs mt-0.5">Pengujian Sensor Kelembaban Ruangan</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100 px-2.5 py-1 rounded-md text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-statusRiset"></span> Riset / TA
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-800 font-medium">Budi Santoso</div>
                                    <div class="text-gray-500 text-xs">Mahasiswa (1904111000)</div>
                                </td>
                            </tr>

                            <!-- Data Row 3 (HIMA) -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">Rabu, 12 Agt 2026</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-700 flex items-center gap-1.5 font-medium"><i class="ph ph-clock text-gray-400"></i> 15:00 - 17:00</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800">Rapat Divisi Ristek</div>
                                    <div class="text-gray-500 text-xs mt-0.5">Persiapan Acara Workshop Web Development</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-md text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-statusHima"></span> HIMATIKA
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-800 font-medium">Divisi Ristek</div>
                                    <div class="text-gray-500 text-xs">Panitia Internal</div>
                                </td>
                            </tr>
                            
                            <!-- Data Row 4 (Praktikum) -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">Kamis, 13 Agt 2026</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-700 flex items-center gap-1.5 font-medium"><i class="ph ph-clock text-gray-400"></i> 13:00 - 15:00</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800">Kecerdasan Buatan</div>
                                    <div class="text-gray-500 text-xs mt-0.5">Penerapan Algoritma A* (Kelas 5B)</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 border border-red-100 px-2.5 py-1 rounded-md text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-statusPraktikum"></span> Praktikum
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="text-gray-800 font-medium">Bpk. Doni, M.Cs</div>
                                    <div class="text-gray-500 text-xs">Dosen Pengampu</div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-4 flex items-center justify-end">
                 <p class="text-xs text-gray-500"><i class="ph ph-info text-sm mr-1"></i> Jadwal di atas dapat berubah sewaktu-waktu mengikuti persetujuan admin lab.</p>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="booking-modal" class="fixed inset-0 z-[100] bg-gray-900/60 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform scale-95 transition-transform duration-300" id="booking-modal-content">
            <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between bg-gray-50">
                <h3 class="font-bold text-lg text-primary flex items-center gap-2"><i class="ph ph-calendar-plus text-accent"></i> Ajukan Peminjaman</h3>
                <button onclick="closeBookingDialog()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-5 flex items-start gap-3">
                    <i class="ph ph-info text-primary text-xl mt-0.5"></i>
                    <div>
                        <p class="text-sm text-blue-900 font-medium">Slot Terpilih:</p>
                        <p class="text-xs text-blue-700" id="modal-slot-info">Lab Komputer A • Selasa, 11 Agt (08:00 - 10:00)</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-600 mb-4">Untuk melanjutkan pengajuan peminjaman ruangan atau alat, Anda diharuskan login terlebih dahulu menggunakan akun SSO Kampus.</p>
                
                <div class="flex flex-col gap-3">
                    <button class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-blue-900 transition-colors shadow flex items-center justify-center gap-2">
                        <i class="ph ph-sign-in"></i> Login SSO Sekarang
                    </button>
                    <button onclick="closeBookingDialog()" class="w-full bg-white text-gray-700 border border-gray-300 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 md:py-16 border-t-4 border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Brand Info -->
                <div class="md:col-span-2 pr-0 md:pr-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="flex items-center gap-2 bg-white/10 backdrop-blur-sm p-1.5 border border-white/10 rounded-full">
                            <img src="{{ asset('ubhara_logo.png') }}" alt="Logo Ubhara" class="shadow-sm rounded-full w-9 h-9">
                            <img src="{{ asset('logo_lab_if.png') }}" alt="Logo Lab" class="shadow-sm rounded-full w-9 h-9">
                            <img src="{{ asset('himatika_logo.png') }}" alt="Logo HIMA" class="shadow-sm rounded-full w-9 h-9">
                        </div>
                        <div>
                            <h2 class="font-bold text-xl text-white leading-tight">Portal IF Ubhara</h2>
                            <p class="text-xs text-gray-400 font-medium">Universitas Bhayangkara Surabaya</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                        Platform terintegrasi pusat informasi dan layanan Laboratorium Teknik Informatika serta website resmi Himpunan Mahasiswa Teknik Informatika (HIMATIKA).
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><i class="ph ph-instagram-logo text-xl"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><i class="ph ph-youtube-logo text-xl"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><i class="ph ph-envelope-simple text-xl"></i></a>
                    </div>
                </div>

                <!-- Links Lab -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Laboratorium</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#laboratorium" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Dashboard Lab</a></li>
                        <li><a href="{{ route('pinjam_alat') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Peminjaman Inventaris</a></li>
                        <li><a href="{{ route('jadwal_lab') }}" class="text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Jadwal Ruangan</a></li>
                        <li><a href="{{ route('lapor') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Lapor Kerusakan</a></li>
                        <li><a href="{{ route('beranda') }}#laboratorium" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> SOP & Tata Tertib</a></li>
                    </ul>
                </div>

                <!-- Links HIMATIKA -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">HIMATIKA</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#himatika" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Profil Organisasi</a></li>
                        <li><a href="{{ route('berita') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Galeri Kegiatan</a></li>
                        <li><a href="{{ route('anggota') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Pendaftaran Anggota</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; 2026 Laboratorium & HIMATIKA Teknik Informatika. Universitas Bhayangkara Surabaya.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Logic
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuIcon = mobileMenuBtn ? mobileMenuBtn.querySelector('i') : null;

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('open');
                    if (mobileMenuIcon) {
                        if (mobileMenu.classList.contains('open')) {
                            mobileMenuIcon.classList.remove('ph-list');
                            mobileMenuIcon.classList.add('ph-x');
                        } else {
                            mobileMenuIcon.classList.remove('ph-x');
                            mobileMenuIcon.classList.add('ph-list');
                        }
                    }
                });

                // Close mobile menu when a link is clicked
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('open');
                        if (mobileMenuIcon) {
                            mobileMenuIcon.classList.remove('ph-x');
                            mobileMenuIcon.classList.add('ph-list');
                        }
                    });
                });
            }

            // Header Scroll Effect
            const header = document.querySelector('header');
            if (header) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 20) {
                        header.classList.add('shadow-md');
                        header.classList.remove('shadow-sm', 'py-1');
                    } else {
                        header.classList.remove('shadow-md');
                        header.classList.add('shadow-sm', 'py-1');
                    }
                });
            }

            // Update UI based on room selection (Mockup behavior)
            const roomSelect = document.getElementById('room-select');
            if (roomSelect) {
                roomSelect.addEventListener('change', (e) => {
                    const roomName = e.target.options[e.target.selectedIndex].text;
                    const calendarContainer = document.querySelector('.calendar-scroll');
                    if (calendarContainer) {
                        calendarContainer.style.opacity = '0.5';
                        setTimeout(() => {
                            calendarContainer.style.opacity = '1';
                        }, 300);
                    }
                });
            }
        });

        // Booking Dialog Logic
        const modal = document.getElementById('booking-modal');
        const modalContent = document.getElementById('booking-modal-content');
        const modalSlotInfo = document.getElementById('modal-slot-info');

        function showBookingDialog(date, time) {
            const roomSelect = document.getElementById('room-select');
            const roomName = roomSelect ? roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0] : 'Lab';
            
            if (modalSlotInfo) {
                modalSlotInfo.textContent = `${roomName} • ${date} (${time})`;
            }
            
            if (modal && modalContent) {
                modal.classList.remove('invisible', 'opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }
        }

        function closeBookingDialog() {
            if (modal && modalContent) {
                modal.classList.add('opacity-0');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                
                setTimeout(() => {
                    modal.classList.add('invisible');
                }, 300);
            }
        }

        // Close modal when clicking outside
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeBookingDialog();
                }
            });
        }
    </script>
</body>
</html>
