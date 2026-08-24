<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Alat Lab - Portal Informatika Ubhara</title>
    
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
                                <a href="{{ route('jadwal_lab') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Jadwal Lab</a>
                                <a href="{{ route('pinjam_alat') }}" class="block px-4 py-2 text-sm text-primary bg-blue-50 font-medium">Peminjaman Alat</a>
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

                <!-- SSO Absensi Button (Desktop) -->
                <div class="hidden md:flex items-center">
                    <a href="{{ route('absensi') }}"
                        class="flex items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm px-5 py-2.5 rounded-lg font-medium text-white transition-colors">
                        <i class="text-lg ph ph-user-circle"></i>
                        Absensi
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
                <a href="{{ route('absensi') }}"
                    class="flex justify-center items-center gap-2 bg-primary hover:bg-blue-900 shadow-sm mt-3 px-5 py-2.5 rounded-lg font-medium text-white transition-colors">
                    <i class="text-lg ph ph-user-circle"></i>
                    Absensi
                </a>
            </div>
        </div>
    </header>

    <!-- Page Header (Hero) -->
    <section class="pt-28 pb-12 md:pt-32 md:pb-16 hero-pattern text-white relative overflow-hidden border-b-4 border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase border border-white/30 backdrop-blur-sm">Inventaris Lab</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2">
                        Peminjaman <span class="text-accent">Alat & Perangkat</span>
                    </h1>
                    <p class="text-blue-100 max-w-2xl">
                        Cari dan ajukan peminjaman alat laboratorium untuk keperluan praktikum, riset TA, atau kegiatan lomba. Pastikan ketersediaan stok sebelum mengajukan.
                    </p>
                </div>
                
                <!-- Quick Info Box -->
                <div class="flex-shrink-0 bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-xl hidden md:flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-accent text-primary flex items-center justify-center text-2xl">
                        <i class="ph ph-bag"></i>
                    </div>
                    <div>
                        <p class="text-sm text-blue-100">Alat Sedang Dipinjam</p>
                        <p class="text-xl font-bold text-white">0 Item</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content: Catalog Section -->
    <section class="py-10 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Flow Banner -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 md:p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">1</div>
                    <p class="text-sm text-primary font-medium">Pilih Alat &<br>Isi Form</p>
                </div>
                <div class="hidden md:block h-px bg-blue-200 flex-1"></div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full border-2 border-primary text-primary flex items-center justify-center font-bold">2</div>
                    <p class="text-sm text-primary font-medium">Tunggu Persetujuan<br>Laboran</p>
                </div>
                <div class="hidden md:block h-px bg-blue-200 flex-1"></div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full border-2 border-primary text-primary flex items-center justify-center font-bold">3</div>
                    <p class="text-sm text-primary font-medium">Ambil Alat di<br>Ruang Admin Lab</p>
                </div>
            </div>

            <!-- Surat Bebas Pinjam Banner -->
            <div class="bg-gradient-to-r from-primary to-blue-900 rounded-2xl p-6 md:p-8 mb-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-md text-white border border-blue-800">
                <div class="flex items-center gap-4 sm:gap-5">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 flex-shrink-0 bg-white/10 rounded-full flex items-center justify-center text-3xl sm:text-4xl backdrop-blur-sm border border-white/20 text-accent">
                        <i class="ph ph-certificate"></i>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold mb-1">Surat Bebas Tanggungan Lab</h3>
                        <p class="text-blue-100 text-sm max-w-xl leading-relaxed">
                            Syarat wajib untuk pendaftaran Sidang Skripsi (TA) atau Yudisium. Pastikan Anda sudah mengembalikan semua alat pinjaman sebelum mengajukan surat ini.
                        </p>
                    </div>
                </div>
                <button onclick="openBebasLabModal()" class="flex-shrink-0 w-full md:w-auto bg-accent text-primary px-6 py-3.5 rounded-xl font-bold shadow-lg hover:bg-yellow-300 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    <i class="ph ph-file-text text-lg"></i> Ajukan Surat Bebas Lab
                </button>
            </div>

            <!-- Search & Filters -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 mb-8 flex flex-col lg:flex-row gap-4">
                <!-- Search Bar -->
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-colors" placeholder="Cari nama alat (contoh: Arduino, Proyektor)...">
                </div>
                
                <!-- Category Filter -->
                <div class="w-full lg:w-64">
                    <select class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-xl border">
                        <option value="semua">Semua Kategori</option>
                        <option value="iot">IoT & Robotika</option>
                        <option value="jaringan">Jaringan Komputer</option>
                        <option value="multimedia">Multimedia & Audio</option>
                        <option value="komputer">Perangkat Komputer</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="w-full lg:w-48">
                    <select class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-xl border">
                        <option value="semua">Semua Status</option>
                        <option value="tersedia">Tersedia (>0)</option>
                        <option value="kosong">Habis Dipinjam</option>
                    </select>
                </div>
            </div>

            <!-- Equipment Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <!-- Item Card 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Arduino+Uno+R3" alt="Arduino Uno R3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-green-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Tersedia
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">IoT & Robotika</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Arduino Uno R3</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Mikrokontroler board berbasis ATmega328P. Cocok untuk riset IoT dasar.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-gray-50 rounded-lg">
                                <span class="text-xs text-gray-500">Stok Lab:</span>
                                <span class="font-bold text-gray-800">15 Unit</span>
                            </div>
                            <button onclick="openBorrowModal('Arduino Uno R3', 15)" class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                <i class="ph ph-hand-coins text-lg"></i> Pinjam Alat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item Card 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Proyektor+Epson" alt="Proyektor Epson" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-green-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Tersedia
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">Multimedia & Audio</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Proyektor Epson EB-E500</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Proyektor XGA 3300 Lumens. Termasuk kabel HDMI & VGA 1.5m.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-gray-50 rounded-lg">
                                <span class="text-xs text-gray-500">Stok Lab:</span>
                                <span class="font-bold text-gray-800">3 Unit</span>
                            </div>
                            <button onclick="openBorrowModal('Proyektor Epson EB-E500', 3)" class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                <i class="ph ph-hand-coins text-lg"></i> Pinjam Alat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item Card 3 (Out of Stock) -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm flex flex-col group opacity-75">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Raspberry+Pi+4" alt="Raspberry Pi 4" class="w-full h-full object-cover grayscale">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-red-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Habis
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">IoT & Robotika</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Raspberry Pi 4 Model B</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">SBC dengan RAM 4GB. Dilengkapi case dan adaptor daya original.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-red-50 text-red-700 rounded-lg">
                                <span class="text-xs">Stok Lab:</span>
                                <span class="font-bold">0 Unit</span>
                            </div>
                            <button disabled class="w-full bg-gray-200 text-gray-500 cursor-not-allowed py-2.5 rounded-xl text-sm font-medium flex items-center justify-center gap-2">
                                <i class="ph ph-clock text-lg"></i> Menunggu Kembali
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item Card 4 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Crimping+Tool" alt="Crimping Tool" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-green-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Tersedia
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">Jaringan Komputer</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Tang Crimping RJ45</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Alat pemotong dan crimping kabel UTP untuk konektor RJ45/RJ11.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-gray-50 rounded-lg">
                                <span class="text-xs text-gray-500">Stok Lab:</span>
                                <span class="font-bold text-gray-800">8 Unit</span>
                            </div>
                            <button onclick="openBorrowModal('Tang Crimping RJ45', 8)" class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                <i class="ph ph-hand-coins text-lg"></i> Pinjam Alat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item Card 5 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Kabel+Roll" alt="Kabel Roll" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-green-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Tersedia
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">Lain-lain</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Kabel Roll Extension</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Kabel ekstensi listrik panjang 15 meter dengan 4 stop kontak.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-gray-50 rounded-lg">
                                <span class="text-xs text-gray-500">Stok Lab:</span>
                                <span class="font-bold text-gray-800">5 Unit</span>
                            </div>
                            <button onclick="openBorrowModal('Kabel Roll Extension', 5)" class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                <i class="ph ph-hand-coins text-lg"></i> Pinjam Alat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item Card 6 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/F3F4F6/6B7280?text=Cisco+Router" alt="Cisco Router" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1.5 rounded-lg text-green-600 shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Tersedia
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[11px] font-bold tracking-wider text-blue-600 uppercase mb-1">Jaringan Komputer</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">Cisco Router 2911</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">Integrated Services Router untuk simulasi praktik jaringan fisik.</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4 p-2 bg-gray-50 rounded-lg">
                                <span class="text-xs text-gray-500">Stok Lab:</span>
                                <span class="font-bold text-gray-800">2 Unit</span>
                            </div>
                            <button onclick="openBorrowModal('Cisco Router 2911', 2)" class="w-full bg-primary text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                <i class="ph ph-hand-coins text-lg"></i> Pinjam Alat
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination (Dummy) -->
            <div class="mt-10 flex items-center justify-center gap-2">
                <button class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i class="ph ph-caret-left"></i>
                </button>
                <button class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center font-medium">1</button>
                <button class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-50 font-medium">2</button>
                <button class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-50 font-medium">3</button>
                <button class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>

        </div>
    </section>

    <!-- Borrowing Form Modal -->
    <div id="borrow-modal" class="fixed inset-0 z-[100] bg-gray-900/60 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform scale-95 transition-transform duration-300 flex flex-col max-h-[90vh]" id="borrow-modal-content">
            <!-- Modal Header -->
            <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between bg-gray-50">
                <h3 class="font-bold text-lg text-primary flex items-center gap-2">
                    <i class="ph ph-clipboard-text text-accent text-xl"></i> Form Pengajuan Peminjaman
                </h3>
                <button onclick="closeBorrowModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <!-- Modal Body (Scrollable) -->
            <div class="p-6 overflow-y-auto custom-scrollbar">
                
                <!-- Login Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 mb-5 flex items-start gap-3">
                    <i class="ph ph-warning-circle text-yellow-600 text-xl mt-0.5"></i>
                    <div>
                        <p class="text-sm text-yellow-800 font-medium">Anda belum login</p>
                        <p class="text-xs text-yellow-700 mt-0.5">Harap <a href="#" class="font-bold underline">Login SSO</a> terlebih dahulu untuk mengirim pengajuan ini.</p>
                    </div>
                </div>

                <form id="borrow-form" onsubmit="event.preventDefault(); alert('Ini hanya mockup. Pada sistem asli, form akan dikirim ke server.'); closeBorrowModal();">
                    <!-- Item Info -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Barang yang Dipinjam</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl border border-gray-200">
                            <p class="font-bold text-gray-800" id="modal-item-name">Nama Barang</p>
                            <p class="text-xs text-gray-500 mt-0.5">Stok maksimal dipinjam: <span id="modal-item-stock" class="font-bold">0</span> unit</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Jumlah</label>
                            <input type="number" id="borrow-qty" min="1" value="1" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Tgl Peminjaman</label>
                            <input type="date" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" required>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Rencana Pengembalian</label>
                        <input type="date" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Keperluan Penggunaan</label>
                        <textarea rows="3" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Contoh: Untuk Praktikum Jaringan Komputer Kelas 3A, Riset Tugas Akhir..." required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Dosen Pengampu / Penanggung Jawab</label>
                        <input type="text" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Nama dosen atau asisten lab (opsional)">
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeBorrowModal()" class="flex-1 bg-white text-gray-700 border border-gray-300 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-primary text-white py-2.5 rounded-xl font-medium hover:bg-blue-900 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <i class="ph ph-paper-plane-tilt text-lg"></i> Ajukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Surat Bebas Lab Modal -->
    <div id="bebas-lab-modal" class="fixed inset-0 z-[100] bg-gray-900/60 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform scale-95 transition-transform duration-300 flex flex-col max-h-[90vh]" id="bebas-lab-modal-content">
            <!-- Modal Header -->
            <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between bg-primary text-white">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <i class="ph ph-certificate text-accent text-xl"></i> Form Surat Bebas Lab
                </h3>
                <button onclick="closeBebasLabModal()" class="text-white/70 hover:text-white transition-colors">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>
            
            <!-- Modal Body (Scrollable) -->
            <div class="p-6 overflow-y-auto custom-scrollbar">
                
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 flex items-start gap-3">
                    <i class="ph ph-info text-blue-600 text-xl mt-0.5"></i>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Surat akan diproses oleh laboran dalam 1-2 hari kerja setelah diajukan. Sistem akan memverifikasi riwayat peminjaman Anda.
                    </p>
                </div>

                <form id="bebas-lab-form" onsubmit="event.preventDefault(); alert('Pengajuan Surat Bebas Lab berhasil dikirim ke sistem. Silakan cek notifikasi secara berkala.'); closeBebasLabModal();">
                    
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                        <input type="text" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 cursor-not-allowed focus:outline-none" value="Budi Santoso" readonly title="Data ditarik otomatis dari akun SSO">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">NPM</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 cursor-not-allowed focus:outline-none" value="1904111000" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Angkatan</label>
                            <select class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer" required>
                                <option value="">Pilih Tahun...</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Keperluan Pengajuan</label>
                        <select class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer" required>
                            <option value="">Pilih keperluan...</option>
                            <option value="skripsi">Pendaftaran Sidang Skripsi (TA)</option>
                            <option value="yudisium">Pendaftaran Yudisium / Wisuda</option>
                            <option value="mutasi">Mutasi / Pindah Kuliah</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Nomor WhatsApp Aktif</label>
                        <input type="tel" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: 081234567890 (Untuk konfirmasi laboran)" required>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeBebasLabModal()" class="flex-1 bg-white text-gray-700 border border-gray-300 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-accent text-primary py-2.5 rounded-xl font-bold hover:bg-yellow-300 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <i class="ph ph-paper-plane-tilt text-lg"></i> Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                        <li><a href="{{ route('pinjam_alat') }}" class="text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Peminjaman Inventaris</a></li>
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
        });

        // Modal Logic
        const borrowModal = document.getElementById('borrow-modal');
        const borrowModalContent = document.getElementById('borrow-modal-content');
        
        function openBorrowModal(itemName, maxStock) {
            // Set dynamic data
            const nameEl = document.getElementById('modal-item-name');
            const stockEl = document.getElementById('modal-item-stock');
            const qtyEl = document.getElementById('borrow-qty');
            if (nameEl) nameEl.textContent = itemName;
            if (stockEl) stockEl.textContent = maxStock;
            if (qtyEl) {
                qtyEl.setAttribute('max', maxStock);
                qtyEl.value = 1;
            }
            
            // Show modal
            if (borrowModal && borrowModalContent) {
                borrowModal.classList.remove('invisible', 'opacity-0');
                borrowModalContent.classList.remove('scale-95');
                borrowModalContent.classList.add('scale-100');
            }
            
            document.body.style.overflow = 'hidden';
        }

        function closeBorrowModal() {
            if (borrowModal && borrowModalContent) {
                borrowModal.classList.add('opacity-0');
                borrowModalContent.classList.remove('scale-100');
                borrowModalContent.classList.add('scale-95');
                
                setTimeout(() => {
                    borrowModal.classList.add('invisible');
                    document.body.style.overflow = 'auto';
                }, 300);
            }
        }

        if (borrowModal) {
            borrowModal.addEventListener('click', (e) => {
                if (e.target === borrowModal) {
                    closeBorrowModal();
                }
            });
        }

        // Bebas Lab Modal Logic
        const bebasLabModal = document.getElementById('bebas-lab-modal');
        const bebasLabModalContent = document.getElementById('bebas-lab-modal-content');

        function openBebasLabModal() {
            if (bebasLabModal && bebasLabModalContent) {
                bebasLabModal.classList.remove('invisible', 'opacity-0');
                bebasLabModalContent.classList.remove('scale-95');
                bebasLabModalContent.classList.add('scale-100');
            }
            document.body.style.overflow = 'hidden';
        }

        function closeBebasLabModal() {
            if (bebasLabModal && bebasLabModalContent) {
                bebasLabModal.classList.add('opacity-0');
                bebasLabModalContent.classList.remove('scale-100');
                bebasLabModalContent.classList.add('scale-95');
                
                setTimeout(() => {
                    bebasLabModal.classList.add('invisible');
                    document.body.style.overflow = 'auto';
                }, 300);
            }
        }

        if (bebasLabModal) {
            bebasLabModal.addEventListener('click', (e) => {
                if (e.target === bebasLabModal) {
                    closeBebasLabModal();
                }
            });
        }
    </script>
</body>
</html>
