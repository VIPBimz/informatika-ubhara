<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Kerusakan Lab - Portal Informatika Ubhara</title>
    
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
        /* File Upload area hover state */
        .upload-area:hover {
            border-color: #1E3A8A;
            background-color: #F0F9FF;
        }
    </style>
</head>
<body class="font-sans bg-neutralBg text-gray-800 antialiased flex flex-col min-h-screen">

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
                                <a href="{{ route('jadwal_lab') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Jadwal Lab</a>
                                <a href="{{ route('pinjam_alat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Peminjaman Alat</a>
                                <a href="{{ route('lapor') }}" class="block px-4 py-2 text-sm text-primary bg-blue-50 font-medium">Lapor Kerusakan</a>
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
                <div class="max-w-3xl">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-red-500/80 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase border border-white/30 backdrop-blur-sm flex items-center gap-1.5">
                            <i class="ph ph-warning"></i> Helpdesk Lab
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2">
                        Laporan <span class="text-accent">Kerusakan Fasilitas</span>
                    </h1>
                    <p class="text-blue-100 max-w-2xl text-sm md:text-base">
                        Menemukan kendala pada PC, jaringan, AC, atau alat praktikum lainnya? Segera laporkan agar teknisi dan laboran kami dapat menindaklanjutinya dengan cepat demi kenyamanan bersama.
                    </p>
                </div>
                
                <!-- Quick Info -->
                <div class="flex-shrink-0 bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-xl hidden md:flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-500/30 text-white flex items-center justify-center text-2xl border border-white/20">
                        <i class="ph ph-wrench"></i>
                    </div>
                    <div>
                        <p class="text-sm text-blue-100">Tiket Selesai Bulan Ini</p>
                        <p class="text-xl font-bold text-white">24 Laporan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-10 md:py-16 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Lapor Form (Takes 5 cols) -->
                <div class="lg:col-span-5 order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-28">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="font-bold text-lg text-primary flex items-center gap-2">
                                <i class="ph ph-clipboard-text text-xl"></i> Form Laporan Baru
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <!-- User Info / Context (Mockup logged in user) -->
                            <div class="mb-6 flex items-center gap-3 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                                <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                                    BS
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Budi Santoso</p>
                                    <p class="text-xs text-gray-500">1904111000 • Mahasiswa</p>
                                </div>
                            </div>

                            <form id="lapor-form" onsubmit="handleFormSubmit(event)">
                                <!-- Lokasi -->
                                <div class="mb-5">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Lokasi / Ruangan <span class="text-red-500">*</span></label>
                                    <select class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer" required>
                                        <option value="">Pilih Ruangan...</option>
                                        <option value="lab-komputer-a">Lab Komputer A (Lt. 2)</option>
                                        <option value="lab-jaringan">Lab Jaringan & IoT (Lt. 2)</option>
                                        <option value="lab-multimedia">Lab Multimedia (Lt. 3)</option>
                                        <option value="lainnya">Lainnya (Peminjaman Dibawa Pulang)</option>
                                    </select>
                                </div>

                                <!-- Nama Alat -->
                                <div class="mb-5">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Nama Alat / Fasilitas <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: PC No. 15, Proyektor, AC..." required>
                                    <p class="text-[11px] text-gray-400 mt-1">Berikan kode inventaris jika ada (misal: PC-A-15).</p>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-5">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Deskripsi Kerusakan <span class="text-red-500">*</span></label>
                                    <textarea rows="4" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Ceritakan detail kendala. Contoh: PC tiba-tiba mati sendiri saat digunakan rendering, tercium bau gosong dari CPU." required></textarea>
                                </div>

                                <!-- File Upload -->
                                <div class="mb-6">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Foto Bukti Kerusakan (Opsional)</label>
                                    <div class="relative upload-area w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer transition-colors" onclick="document.getElementById('file-upload').click()">
                                        <input type="file" id="file-upload" class="hidden" accept="image/*">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <i class="ph ph-image text-3xl text-gray-400"></i>
                                            <p class="text-sm text-gray-600 font-medium">Klik untuk unggah foto</p>
                                            <p class="text-xs text-gray-400">Format JPG, PNG (Max. 5MB)</p>
                                        </div>
                                    </div>
                                    <div id="file-name" class="text-xs text-green-600 font-medium mt-2 hidden flex items-center gap-1">
                                        <i class="ph ph-check-circle"></i> <span>Foto berhasil dipilih.</span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold hover:bg-blue-900 transition-colors shadow-md flex items-center justify-center gap-2 group">
                                    <i class="ph ph-paper-plane-tilt text-lg group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i> Kirim Laporan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Status Tracking (Takes 7 cols) -->
                <div class="lg:col-span-7 order-1 lg:order-2 mb-8 lg:mb-0">
                    
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Pantau Laporan</h2>
                            <p class="text-sm text-gray-500">Transparansi status perbaikan fasilitas laboratorium.</p>
                        </div>
                        
                        <div class="hidden sm:block">
                            <select class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer">
                                <option>Semua Status</option>
                                <option>Menunggu</option>
                                <option>Diproses</option>
                                <option>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <!-- List of Reports -->
                    <div class="space-y-4">
                        
                        <!-- Report Card 1 (In Progress) -->
                        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500"></div>
                            <div class="flex flex-col sm:flex-row justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="bg-blue-100 text-blue-700 text-[11px] font-bold px-2 py-0.5 rounded uppercase tracking-wider flex items-center gap-1">
                                            <i class="ph ph-spinner-gap animate-spin"></i> Sedang Diperbaiki
                                        </span>
                                        <span class="text-xs text-gray-400 font-medium">No. Tiket: #TK-0089</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Air Conditioner (AC) Bocor Menetes</h3>
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        AC yang berada di sudut kiri belakang ruangan meneteskan air cukup deras mengenai meja praktikan. Mohon segera diperbaiki agar tidak mengenai PC.
                                    </p>
                                    
                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1"><i class="ph ph-map-pin text-gray-400 text-base"></i> Lab Jaringan & IoT</span>
                                        <span class="flex items-center gap-1"><i class="ph ph-user text-gray-400 text-base"></i> Budi S.</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 border-t sm:border-t-0 sm:border-l border-gray-100 pt-3 sm:pt-0 sm:pl-4">
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wide">Tgl Lapor</p>
                                        <p class="text-sm font-semibold text-gray-700">10 Agt 2026</p>
                                    </div>
                                    <div class="text-right mt-0 sm:mt-auto">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wide">Update Terakhir</p>
                                        <p class="text-xs font-medium text-blue-600">Teknisi sedang cek (Hari ini)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Report Card 2 (Waiting) -->
                        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-yellow-400"></div>
                            <div class="flex flex-col sm:flex-row justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="bg-yellow-100 text-yellow-800 text-[11px] font-bold px-2 py-0.5 rounded uppercase tracking-wider flex items-center gap-1">
                                            <i class="ph ph-clock"></i> Menunggu Pengecekan
                                        </span>
                                        <span class="text-xs text-gray-400 font-medium">No. Tiket: #TK-0090</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Monitor PC Client 12 Mati Total</h3>
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        CPU menyala namun monitor sama sekali tidak menampilkan gambar. Indikator power di monitor juga mati. Kabel power sudah dipastikan terpasang.
                                    </p>
                                    
                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1"><i class="ph ph-map-pin text-gray-400 text-base"></i> Lab Komputer A</span>
                                        <span class="flex items-center gap-1"><i class="ph ph-user text-gray-400 text-base"></i> Rina M.</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 border-t sm:border-t-0 sm:border-l border-gray-100 pt-3 sm:pt-0 sm:pl-4">
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wide">Tgl Lapor</p>
                                        <p class="text-sm font-semibold text-gray-700">10 Agt 2026</p>
                                    </div>
                                    <div class="text-right mt-0 sm:mt-auto text-gray-400 text-xs">
                                        Menunggu antrean teknisi
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Report Card 3 (Done) -->
                        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden opacity-75">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500"></div>
                            <div class="flex flex-col sm:flex-row justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="bg-green-100 text-green-700 text-[11px] font-bold px-2 py-0.5 rounded uppercase tracking-wider flex items-center gap-1">
                                            <i class="ph ph-check-circle"></i> Selesai Diperbaiki
                                        </span>
                                        <span class="text-xs text-gray-400 font-medium">No. Tiket: #TK-0082</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1 line-through decoration-gray-400">Tang Crimping Macet/Keras</h3>
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        Tang crimping dengan stiker merah (RJ45) bagian pemotongnya macet dan tidak bisa terbuka otomatis.
                                    </p>
                                    
                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1"><i class="ph ph-map-pin text-gray-400 text-base"></i> Peminjaman Dibawa Pulang</span>
                                        <span class="flex items-center gap-1"><i class="ph ph-user text-gray-400 text-base"></i> Dwi K.</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 border-t sm:border-t-0 sm:border-l border-gray-100 pt-3 sm:pt-0 sm:pl-4">
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wide">Tgl Lapor</p>
                                        <p class="text-sm font-semibold text-gray-700">05 Agt 2026</p>
                                    </div>
                                    <div class="text-right mt-0 sm:mt-auto">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wide">Selesai Pada</p>
                                        <p class="text-sm font-semibold text-gray-700">07 Agt 2026</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Pagination (Dummy) -->
                    <div class="mt-8 flex justify-center">
                        <button class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-5 py-2.5 rounded-xl font-medium transition-colors text-sm">
                            Muat Lebih Banyak Laporan
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Custom Toast Message Box -->
    <div id="toast-success" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl transform translate-y-32 opacity-0 transition-all duration-500 flex items-center gap-3 z-[100] border border-green-500">
        <i class="ph ph-check-circle text-2xl"></i>
        <div>
            <h4 class="font-bold text-sm">Laporan Berhasil Dikirim!</h4>
            <p class="text-xs text-green-100">Tim teknisi lab akan segera mengecek laporan Anda.</p>
        </div>
        <button onclick="hideToast()" class="ml-4 text-green-200 hover:text-white transition-colors">
            <i class="ph ph-x"></i>
        </button>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 md:py-16 border-t-4 border-accent mt-auto">
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
                </div>

                <!-- Links Lab -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Laboratorium</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('jadwal_lab') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Jadwal Ruangan</a></li>
                        <li><a href="{{ route('pinjam_alat') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Peminjaman Inventaris</a></li>
                        <li><a href="{{ route('lapor') }}" class="text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Lapor Kerusakan</a></li>
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
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; 2026 Laboratorium & HIMATIKA Teknik Informatika. Universitas Bhayangkara Surabaya.</p>
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

            // File input logic
            const fileInput = document.getElementById('file-upload');
            const fileNameDisplay = document.getElementById('file-name');

            if (fileInput && fileNameDisplay) {
                const fileNameText = fileNameDisplay.querySelector('span');
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        if (fileNameText) fileNameText.textContent = `File terpilih: ${this.files[0].name}`;
                        fileNameDisplay.classList.remove('hidden');
                    } else {
                        fileNameDisplay.classList.add('hidden');
                    }
                });
            }
        });

        // Form Submit Logic & Toast Handling
        let toastTimeout;
        const toast = document.getElementById('toast-success');
        const form = document.getElementById('lapor-form');
        const fileDisplay = document.getElementById('file-name');

        function handleFormSubmit(event) {
            event.preventDefault();
            showToast();
            if (form) form.reset();
            if (fileDisplay) fileDisplay.classList.add('hidden');
        }

        function showToast() {
            if (!toast) return;
            clearTimeout(toastTimeout);
            toast.classList.remove('translate-y-32', 'opacity-0');
            
            toastTimeout = setTimeout(() => {
                hideToast();
            }, 4000);
        }

        function hideToast() {
            if (toast) {
                toast.classList.add('translate-y-32', 'opacity-0');
            }
        }
    </script>
</body>
</html>
