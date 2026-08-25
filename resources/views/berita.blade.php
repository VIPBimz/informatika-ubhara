<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Acara HIMATIKA - Portal IF Ubhara</title>
    
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
        
        /* Custom Scrollbar for Agenda to prevent layout breaking if too long */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }

        /* Tab transition */
        .tab-active {
            background-color: #1E3A8A;
            color: white;
            border-color: #1E3A8A;
        }
        .tab-inactive {
            background-color: transparent;
            color: #4B5563;
            border-color: transparent;
        }
    </style>
</head>
<body class="font-sans bg-neutralBg text-gray-800 antialiased flex flex-col min-h-screen">

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
                        <a href="{{ url('/#laboratorium') }}" class="text-gray-600 hover:text-primary font-medium px-1 py-2 flex items-center gap-1 transition-colors">
                            Laboratorium <i class="ph ph-caret-down text-sm"></i>
                        </a>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('jadwal_lab') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Jadwal Lab</a>
                                <a href="{{ route('pinjam_alat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Peminjaman Alat</a>
                                <a href="{{ route('lapor') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Lapor Kerusakan</a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <a href="{{ url('/#himatika') }}" class="text-primary font-semibold border-b-2 border-accent px-1 py-2 flex items-center gap-1 transition-colors">
                            HIMATIKA <i class="ph ph-caret-down text-sm"></i>
                        </a>
                         <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('berita') }}" class="block px-4 py-2 text-sm text-primary bg-blue-50 font-medium">Berita & Acara</a>
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

    <!-- Top Featured Section -->
    <section class="pt-28 pb-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-primary font-bold tracking-widest text-xs uppercase flex items-center gap-2 mb-1">
                        <i class="ph ph-newspaper"></i> Seputar Informatika
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Kabar HIMATIKA</h1>
                </div>
            </div>

            <!-- Featured News Layout -->
            <div class="relative rounded-3xl overflow-hidden group shadow-lg border border-gray-100 bg-gray-900 flex flex-col md:flex-row h-auto md:h-[450px]">
                
                <!-- Background Image -->
                <div class="w-full md:w-3/5 h-64 md:h-full relative overflow-hidden">
                    <img src="https://placehold.co/1200x800/1E3A8A/FFFFFF?text=TechDays+2026" alt="Featured News" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-gray-900 md:from-transparent to-transparent opacity-80 md:opacity-100"></div>
                </div>
                
                <!-- Content Box -->
                <div class="w-full md:w-2/5 flex flex-col justify-center p-8 md:p-12 relative z-10 bg-gray-900 md:bg-gradient-to-l md:from-gray-900 md:via-gray-900 md:to-transparent">
                    <div class="flex gap-2 mb-4">
                        <span class="bg-accent text-primary text-xs font-bold px-3 py-1 rounded-full">Event Utama</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-snug group-hover:text-accent transition-colors">
                        HIMATIKA Sukses Gelar TechDays 2026, Hadirkan Pakar Nasional
                    </h2>
                    <p class="text-gray-300 text-sm md:text-base line-clamp-3 mb-6">
                        Acara tahunan terbesar Teknik Informatika Universitas Bhayangkara Surabaya kembali digelar dengan meriah. Ratusan mahasiswa antusias mengikuti berbagai seminar, workshop, hingga pameran karya inovasi IT.
                    </p>
                    
                    <div class="mt-auto">
                        <div class="flex items-center gap-3 text-white/70 text-xs mb-5">
                            <span class="flex items-center gap-1.5"><i class="ph ph-user"></i> Divisi Kominfo</span>
                            <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                            <span class="flex items-center gap-1.5"><i class="ph ph-calendar-blank"></i> 10 Agt 2026</span>
                        </div>
                        <a href="#" class="inline-flex items-center gap-2 text-accent font-bold hover:text-white transition-colors">
                            Baca Selengkapnya <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Content Area -->
    <section class="py-10 flex-grow bg-neutralBg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left Column: News Feed (Takes 8 cols) -->
                <div class="lg:col-span-8">
                    
                    <!-- Filters/Tabs -->
                    <div class="flex flex-wrap items-center gap-2 mb-8 bg-white p-2 rounded-xl shadow-sm border border-gray-100">
                        <button class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors tab-active">Terkini</button>
                        <button class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors tab-inactive hover:bg-gray-50">Pengumuman</button>
                        <button class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors tab-inactive hover:bg-gray-50">Prestasi</button>
                        <button class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors tab-inactive hover:bg-gray-50">Workshop</button>
                    </div>

                    <!-- News List -->
                    <div class="space-y-5">
                        
                        <!-- News Item 1 -->
                        <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col sm:flex-row p-3 gap-5">
                            <div class="relative w-full sm:w-64 sm:h-auto h-48 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="https://placehold.co/600x400/10B981/FFFFFF?text=Hackathon" alt="Prestasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 backdrop-blur text-green-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm">Prestasi</span>
                                </div>
                            </div>
                            <div class="py-2 pr-4 flex flex-col justify-center flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-primary transition-colors">
                                    <a href="#">Tim Mahasiswa IF Ubhara Raih Juara 1 Nasional Hackathon Kota Cerdas</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                    Membanggakan! Tim "Cyber Bhayangkara" berhasil menciptakan aplikasi pemantau emisi karbon dan memenangkan kompetisi bergengsi.
                                </p>
                                <div class="mt-auto flex items-center text-xs text-gray-400 gap-4">
                                    <span class="flex items-center gap-1"><i class="ph ph-calendar-blank"></i> 08 Agt 2026</span>
                                    <span class="flex items-center gap-1"><i class="ph ph-user"></i> Humas HIMATIKA</span>
                                </div>
                            </div>
                        </article>

                        <!-- News Item 2 -->
                        <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col sm:flex-row p-3 gap-5">
                            <div class="relative w-full sm:w-64 sm:h-auto h-48 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="https://placehold.co/600x400/EF4444/FFFFFF?text=Pengumuman" alt="Pengumuman" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 grayscale group-hover:grayscale-0">
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 backdrop-blur text-red-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm">Pengumuman</span>
                                </div>
                            </div>
                            <div class="py-2 pr-4 flex flex-col justify-center flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-primary transition-colors">
                                    <a href="#">Jadwal Pengambilan Jas Almamater & Kemeja Himpunan Angkatan 2025</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                    Diberitahukan kepada seluruh anggota baru HIMATIKA angkatan 2025, pengambilan atribut wajib dilakukan minggu ini.
                                </p>
                                <div class="mt-auto flex items-center text-xs text-gray-400 gap-4">
                                    <span class="flex items-center gap-1"><i class="ph ph-calendar-blank"></i> 05 Agt 2026</span>
                                    <span class="flex items-center gap-1"><i class="ph ph-user"></i> Divisi Internal</span>
                                </div>
                            </div>
                        </article>

                        <!-- News Item 3 -->
                        <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col sm:flex-row p-3 gap-5">
                            <div class="relative w-full sm:w-64 sm:h-auto h-48 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="https://placehold.co/600x400/3B82F6/FFFFFF?text=React+JS" alt="Workshop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 backdrop-blur text-blue-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm">Workshop</span>
                                </div>
                            </div>
                            <div class="py-2 pr-4 flex flex-col justify-center flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-primary transition-colors">
                                    <a href="#">Buka Pendaftaran: Pelatihan Dasar React JS & Tailwind CSS</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                    Divisi Ristek kembali mengadakan pelatihan rutin. Kuota terbatas hanya untuk 30 orang peserta. Daftar sekarang!
                                </p>
                                <div class="mt-auto flex items-center text-xs text-gray-400 gap-4">
                                    <span class="flex items-center gap-1"><i class="ph ph-calendar-blank"></i> 02 Agt 2026</span>
                                    <span class="flex items-center gap-1"><i class="ph ph-user"></i> Divisi Ristek</span>
                                </div>
                            </div>
                        </article>

                        <!-- News Item 4 -->
                        <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col sm:flex-row p-3 gap-5">
                            <div class="relative w-full sm:w-64 sm:h-auto h-48 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="https://placehold.co/600x400/FBBF24/1E3A8A?text=Kunjungan" alt="Event" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 backdrop-blur text-yellow-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm">Event</span>
                                </div>
                            </div>
                            <div class="py-2 pr-4 flex flex-col justify-center flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-primary transition-colors">
                                    <a href="#">Kunjungan Industri Mahasiswa IF ke Data Center PT. Telkom</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                    Melihat langsung infrastruktur server berskala enterprise untuk menambah wawasan mahasiswa mengenai prospek kerja jaringan.
                                </p>
                                <div class="mt-auto flex items-center text-xs text-gray-400 gap-4">
                                    <span class="flex items-center gap-1"><i class="ph ph-calendar-blank"></i> 28 Jul 2026</span>
                                    <span class="flex items-center gap-1"><i class="ph ph-user"></i> Divisi Eksternal</span>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- Pagination -->
                    <div class="mt-10 flex items-center justify-center gap-2">
                        <button class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 disabled:opacity-50 bg-white" disabled>
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center font-medium shadow-sm">1</button>
                        <button class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-50 font-medium bg-white transition-colors">2</button>
                        <button class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-50 font-medium bg-white transition-colors hidden sm:flex">3</button>
                        <span class="text-gray-400 px-1">...</span>
                        <button class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 bg-white transition-colors">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>

                </div>

                <!-- Right Column: Sidebar -->
                <div class="lg:col-span-4 sticky top-28 space-y-6 flex flex-col">
                    
                    <!-- Widget: Kategori Berita -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <h3 class="font-bold text-gray-800 text-base mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                            <i class="ph ph-tag text-primary"></i> Kategori Berita
                        </h3>
                        <div class="flex flex-col gap-2">
                            <a href="#" class="flex justify-between items-center text-sm text-gray-600 hover:text-primary hover:bg-blue-50 px-3 py-2 rounded-lg transition-colors">
                                <span>Seputar Kampus</span>
                                <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-bold">24</span>
                            </a>
                            <a href="#" class="flex justify-between items-center text-sm text-gray-600 hover:text-primary hover:bg-blue-50 px-3 py-2 rounded-lg transition-colors">
                                <span>Event & Workshop</span>
                                <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-bold">18</span>
                            </a>
                            <a href="#" class="flex justify-between items-center text-sm text-gray-600 hover:text-primary hover:bg-blue-50 px-3 py-2 rounded-lg transition-colors">
                                <span>Info Akademik</span>
                                <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-bold">12</span>
                            </a>
                            <a href="#" class="flex justify-between items-center text-sm text-gray-600 hover:text-primary hover:bg-blue-50 px-3 py-2 rounded-lg transition-colors">
                                <span>Prestasi Mahasiswa</span>
                                <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-bold">8</span>
                            </a>
                        </div>
                    </div>

                    <!-- Widget: Agenda Mendatang -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                        <div class="p-5 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
                                <i class="ph ph-calendar-check text-primary"></i> Agenda Mendatang
                            </h3>
                        </div>
                        
                        <div class="p-2 custom-scrollbar overflow-y-auto max-h-[320px]">
                            
                            <!-- Agenda Item 1 -->
                            <a href="#" class="flex gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 w-12 h-14 bg-white rounded-lg flex flex-col items-center justify-center border border-gray-200 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-blue-200 uppercase">Agt</span>
                                    <span class="text-lg font-bold leading-none text-gray-800 group-hover:text-white">15</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-primary transition-colors leading-snug mb-1">Pelatihan React JS & Tailwind</h4>
                                    <p class="text-[11px] text-gray-500 flex items-center gap-1"><i class="ph ph-clock text-gray-400"></i> 09:00 - Selesai</p>
                                </div>
                            </a>
                            
                            <!-- Agenda Item 2 -->
                            <a href="#" class="flex gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 w-12 h-14 bg-white rounded-lg flex flex-col items-center justify-center border border-gray-200 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-blue-200 uppercase">Agt</span>
                                    <span class="text-lg font-bold leading-none text-gray-800 group-hover:text-white">20</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-primary transition-colors leading-snug mb-1">Rapat Kerja HIMATIKA</h4>
                                    <p class="text-[11px] text-gray-500 flex items-center gap-1"><i class="ph ph-clock text-gray-400"></i> 15:00 WIB</p>
                                </div>
                            </a>

                            <!-- Agenda Item 3 -->
                            <a href="#" class="flex gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 w-12 h-14 bg-white rounded-lg flex flex-col items-center justify-center border border-gray-200 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-blue-200 uppercase">Sep</span>
                                    <span class="text-lg font-bold leading-none text-gray-800 group-hover:text-white">01</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-primary transition-colors leading-snug mb-1">Turnamen E-Sports IF 2026</h4>
                                    <p class="text-[11px] text-gray-500 flex items-center gap-1"><i class="ph ph-map-pin text-gray-400"></i> Online (Discord)</p>
                                </div>
                            </a>
                            
                        </div>
                        <div class="p-4 border-t border-gray-100 text-center">
                            <a href="#" class="text-xs font-bold text-primary hover:text-blue-900 transition-colors uppercase tracking-wider">Lihat Semua Kalender</a>
                        </div>
                    </div>

                    <!-- Widget: Media Sosial -->
                    <div class="bg-gradient-to-br from-primary to-blue-900 rounded-2xl border border-blue-800 shadow-md p-6 text-white text-center">
                        <h3 class="font-bold text-base mb-2">Terhubung dengan Kami</h3>
                        <p class="text-blue-200 text-xs mb-5">Dapatkan update terkini langsung dari media sosial resmi HIMATIKA.</p>
                        
                        <div class="flex justify-center gap-3">
                            <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full flex items-center justify-center transition-all hover:scale-110">
                                <i class="ph ph-instagram-logo text-2xl text-pink-300"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full flex items-center justify-center transition-all hover:scale-110">
                                <i class="ph ph-youtube-logo text-2xl text-red-400"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full flex items-center justify-center transition-all hover:scale-110">
                                <i class="ph ph-tiktok-logo text-2xl text-white"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

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
                        <li><a href="{{ route('lapor') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Lapor Kerusakan</a></li>
                        <li><a href="{{ route('beranda') }}#laboratorium" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> SOP & Tata Tertib</a></li>
                    </ul>
                </div>

                <!-- Links HIMATIKA -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">HIMATIKA</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#himatika" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Profil Organisasi</a></li>
                        <li><a href="{{ route('berita') }}" class="text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Galeri Kegiatan</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; 2026 Laboratorium & HIMATIKA Teknik Informatika. Universitas Bhayangkara Surabaya.</p>
            </div>
        </div>
    </footer>

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
            
            // Simple Filter Logic
            const filterButtons = document.querySelectorAll('.tab-active, .tab-inactive');
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => {
                        b.classList.remove('tab-active');
                        b.classList.add('tab-inactive');
                        b.classList.add('hover:bg-gray-50');
                    });
                    
                    this.classList.remove('tab-inactive', 'hover:bg-gray-50');
                    this.classList.add('tab-active');
                    
                    const feed = document.querySelector('.space-y-5');
                    if (feed) {
                        feed.style.opacity = '0.5';
                        setTimeout(() => {
                            feed.style.opacity = '1';
                        }, 300);
                    }
                });
            });
        });
    </script>
</body>
</html>
