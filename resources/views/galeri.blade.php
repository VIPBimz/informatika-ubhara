<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan HIMATIKA - Portal IF Ubhara</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

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
        /* Hide scrollbar when modal is open */
        body.modal-open {
            overflow: hidden;
        }
        
        /* Filter Button Active State */
        .filter-active {
            background-color: #1E3A8A;
            color: white;
            border-color: #1E3A8A;
        }
        
        /* Image Hover Overlay transition */
        .gallery-overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .group:hover .gallery-overlay {
            opacity: 1;
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
                                <a href="{{ route('berita') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Berita & Acara</a>
                                <a href="{{ route('galeri') }}" class="block px-4 py-2 text-sm text-primary bg-blue-50 font-medium">Galeri</a>
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

    <section class="pt-28 pb-12 hero-pattern border-b-4 border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-sm font-medium backdrop-blur-sm text-white mb-4">
                <i class="ph ph-images text-accent"></i> Dokumentasi Terpadu
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Galeri <span class="text-accent">Kegiatan</span></h1>
            <p class="text-blue-100 max-w-2xl mx-auto text-sm md:text-base">
                Kumpulan memori, dokumentasi acara, workshop, dan keseruan aktivitas mahasiswa Teknik Informatika Universitas Bhayangkara Surabaya.
            </p>
        </div>
    </section>

    <section class="py-10 flex-grow bg-neutralBg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filters -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
                <button class="filter-btn filter-active px-5 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-colors shadow-sm" data-filter="all">Semua</button>
                <button class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-5 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-colors shadow-sm" data-filter="techdays">TechDays</button>
                <button class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-5 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-colors shadow-sm" data-filter="workshop">Workshop</button>
                <button class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-5 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-colors shadow-sm" data-filter="kunjungan">Kunjungan Industri</button>
                <button class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-5 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-colors shadow-sm" data-filter="makrab">Makrab</button>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="gallery-grid">
                
                <!-- Gallery Item 1 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="techdays" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/1E3A8A/FFFFFF?text=Pembukaan+TechDays" alt="Pembukaan TechDays 2026" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-accent text-primary text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">TechDays</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Pembukaan TechDays 2026</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 10 Agt 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="workshop" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/10B981/FFFFFF?text=Workshop+React" alt="Workshop React JS" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">Workshop</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Pelatihan Dasar React JS</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 02 Agt 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="kunjungan" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/EF4444/FFFFFF?text=Kunjungan+Telkom" alt="Kunjungan Industri Telkom" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">Kunjungan Industri</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Kunjungan ke Data Center Telkom</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 28 Jul 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="techdays" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/F59E0B/FFFFFF?text=Pameran+Inovasi" alt="Pameran Inovasi TechDays" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-accent text-primary text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">TechDays</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Pameran Karya Inovasi IT</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 11 Agt 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 5 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="makrab" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/8B5CF6/FFFFFF?text=Makrab+Angkatan+25" alt="Makrab Angkatan 2025" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-purple-500 text-white text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">Makrab</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Malam Keakraban Angkatan 2025</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 15 Jul 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 6 -->
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-gray-100 aspect-[4/3] cursor-pointer gallery-item" data-category="techdays" onclick="openLightbox(this)">
                    <img src="https://placehold.co/800x600/3B82F6/FFFFFF?text=Seminar+Nasional" alt="Seminar Nasional TechDays" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent flex flex-col justify-end p-5">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-accent text-primary text-[10px] font-bold px-2 py-1 rounded mb-2 inline-block">TechDays</span>
                            <h3 class="text-white font-bold text-lg leading-tight mb-1 caption-title">Seminar Nasional AI & Data</h3>
                            <p class="text-gray-300 text-xs flex items-center gap-1 caption-date"><i class="ph ph-calendar-blank"></i> 12 Agt 2026</p>
                        </div>
                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity delay-100">
                            <i class="ph ph-magnifying-glass-plus text-xl"></i>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Load More Button -->
            <div class="mt-12 text-center">
                <button class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-primary px-8 py-3 rounded-full font-semibold transition-all shadow-sm inline-flex items-center gap-2">
                    <i class="ph ph-spinner gap"></i> Muat Lebih Banyak
                </button>
            </div>

        </div>
    </section>

    <div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex flex-col items-center justify-center p-4 sm:p-10">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-6 right-6 w-12 h-12 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-colors z-50">
            <i class="ph ph-x text-2xl"></i>
        </button>
        
        <!-- Image Container -->
        <div class="relative max-w-5xl w-full flex flex-col items-center justify-center transform scale-95 transition-transform duration-300" id="lightbox-content">
            <img id="lightbox-img" src="" alt="Gallery Image" class="max-h-[75vh] w-auto max-w-full rounded-lg shadow-2xl object-contain">
            
            <!-- Caption -->
            <div class="mt-6 text-center text-white w-full max-w-2xl px-4">
                <h3 id="lightbox-title" class="text-xl md:text-2xl font-bold mb-2">Judul Foto</h3>
                <p id="lightbox-date" class="text-gray-400 text-sm flex items-center justify-center gap-1.5"><i class="ph ph-calendar-blank"></i> Tanggal</p>
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
                        <li><a href="{{ route('berita') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-accent transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Galeri Kegiatan</a></li>
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
            
            // Gallery Filter Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // 1. Update Button Styling
                    filterBtns.forEach(b => {
                        b.classList.remove('filter-active');
                        b.classList.add('bg-white', 'text-gray-600', 'hover:bg-gray-50');
                    });
                    btn.classList.add('filter-active');
                    btn.classList.remove('bg-white', 'text-gray-600', 'hover:bg-gray-50');

                    // 2. Filter Grid Items
                    const targetCategory = btn.getAttribute('data-filter');
                    
                    galleryItems.forEach(item => {
                        // Apply subtle fade out
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.95)';
                        
                        setTimeout(() => {
                            if (targetCategory === 'all' || item.getAttribute('data-category') === targetCategory) {
                                item.style.display = 'block';
                                setTimeout(() => {
                                    item.style.opacity = '1';
                                    item.style.transform = 'scale(1)';
                                }, 50);
                            } else {
                                item.style.display = 'none';
                            }
                        }, 300);
                    });
                });
            });
        });

        // Lightbox Logic
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxTitle = document.getElementById('lightbox-title');
        const lightboxDate = document.getElementById('lightbox-date');
        const lightboxContent = document.getElementById('lightbox-content');

        function openLightbox(element) {
            const img = element.querySelector('img');
            const title = element.querySelector('.caption-title');
            const date = element.querySelector('.caption-date');

            if (!lightbox || !lightboxImg || !lightboxTitle || !lightboxDate || !lightboxContent) return;

            lightboxImg.src = img ? img.src : '';
            lightboxTitle.textContent = title ? title.textContent : '';
            lightboxDate.innerHTML = date ? date.innerHTML : '';

            lightbox.classList.remove('invisible', 'opacity-0');
            setTimeout(() => {
                lightboxContent.classList.remove('scale-95');
                lightboxContent.classList.add('scale-100');
            }, 50);

            document.body.classList.add('modal-open');
        }

        function closeLightbox() {
            if (!lightbox || !lightboxContent || !lightboxImg) return;
            lightboxContent.classList.remove('scale-100');
            lightboxContent.classList.add('scale-95');
            lightbox.classList.add('opacity-0');
            
            setTimeout(() => {
                lightbox.classList.add('invisible');
                lightboxImg.src = '';
                document.body.classList.remove('modal-open');
            }, 300);
        }

        if (lightbox) {
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (lightbox && e.key === 'Escape' && !lightbox.classList.contains('invisible')) {
                closeLightbox();
            }
        });
    </script>
</body>
</html>
