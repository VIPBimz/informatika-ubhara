<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Informatika - Universitas Bhayangkara Surabaya</title>

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
                        primary: '#1E3A8A', // Biru Tua dari PRD
                        accent: '#FBBF24',  // Kuning Cerah dari PRD
                        neutralBg: '#F3F4F6', // Abu-abu muda
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Styles for slight enhancements */
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

<body class="bg-neutralBg font-sans text-gray-800 antialiased">

    <!-- Navigation -->
    <header class="top-0 z-50 fixed shadow-sm border-gray-200 border-b w-full transition-all duration-300 glass-nav">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex flex-shrink-0 items-center gap-3">
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
                        <h1 class="font-bold text-primary text-xl leading-tight">Portal IF</h1>
                        <p class="font-medium text-gray-500 text-xs">Ubhara Surabaya</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('beranda') }}"
                        class="px-1 py-2 border-accent border-b-2 font-semibold text-primary">Beranda</a>

                    <!-- Lab Dropdown Trigger -->
                    <div class="group relative">
                        <a href="#laboratorium"
                            class="flex items-center gap-1 px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">
                            Laboratorium <i class="text-sm ph-caret-down ph"></i>
                        </a>
                        <!-- Dropdown Content -->
                        <div
                            class="invisible group-hover:visible left-0 absolute bg-white opacity-0 group-hover:opacity-100 shadow-lg mt-2 border border-gray-100 rounded-xl w-48 transition-all duration-200">
                            <div class="py-2">
                                <a href="{{ route('jadwal_lab') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Jadwal Lab</a>
                                <a href="{{ route('pinjam_alat') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Peminjaman Alat</a>
                                <a href="{{ route('lapor') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Lapor Kerusakan</a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <a href="#himatika"
                            class="flex items-center gap-1 px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">
                            HIMATIKA <i class="text-sm ph-caret-down ph"></i>
                        </a>
                        <div
                            class="invisible group-hover:visible left-0 absolute bg-white opacity-0 group-hover:opacity-100 shadow-lg mt-2 border border-gray-100 rounded-xl w-48 transition-all duration-200">
                            <div class="py-2">
                                <a href="{{ route('berita') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Berita & Acara</a>
                                <a href="{{ route('galeri') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('anggota') }}" class="px-1 py-2 font-medium text-gray-600 hover:text-primary">Anggota</a>
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
                    <button id="mobile-menu-btn" class="p-2 focus:outline-none text-primary hover:text-blue-900">
                        <i class="text-2xl ph ph-list"></i>
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
                <a href="#laboratorium"
                    class="block hover:bg-gray-50 px-3 py-2 rounded-lg font-medium text-gray-700 hover:text-primary text-base transition-colors">Laboratorium</a>
                <a href="#himatika"
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

    <!-- Hero Section -->
    <section class="relative pt-28 md:pt-36 pb-16 md:pb-24 overflow-hidden text-white hero-pattern">
        <div class="z-10 relative mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="items-center gap-12 grid grid-cols-1 md:grid-cols-2">

                <!-- Hero Text -->
                <div class="space-y-6 md:text-left text-center">
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-1 border border-white/20 rounded-full font-medium text-sm">
                        <span class="bg-accent rounded-full w-2 h-2 animate-pulse"></span>
                        Portal Terintegrasi Versi 2.0
                    </div>

                    <h1 class="font-bold text-4xl md:text-5xl lg:text-6xl leading-tight">
                        Pusat Layanan <span class="text-accent">Informatika</span>
                    </h1>

                    <p class="mx-auto md:mx-0 max-w-xl text-blue-100 text-lg">
                        Satu pintu untuk semua kebutuhan mahasiswa Teknik Informatika Universitas Bhayangkara Surabaya.
                        Akses laboratorium dan kegiatan HIMATIKA lebih mudah, cepat, dan transparan.
                    </p>

                    <div class="flex sm:flex-row flex-col justify-center md:justify-start gap-4 pt-4">
                        <a href="#laboratorium"
                            class="flex justify-center items-center gap-2 bg-accent hover:bg-yellow-300 shadow-lg px-6 py-3 rounded-xl font-semibold text-primary transition-all hover:-translate-y-0.5">
                            <i class="text-xl ph ph-flask"></i> Layanan Lab
                        </a>
                        <a href="#himatika"
                            class="flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm px-6 py-3 border border-white/30 rounded-xl font-semibold text-white transition-all hover:-translate-y-0.5">
                            <i class="text-xl ph ph-users-three"></i> Portal HIMATIKA
                        </a>
                    </div>
                </div>

                <!-- Hero Image/Illustration -->
                <div class="hidden md:block relative">
                    <div
                        class="absolute inset-0 bg-accent opacity-20 blur-3xl rounded-full -translate-y-10 translate-x-10 transform">
                    </div>
                    <div
                        class="relative bg-white/10 shadow-2xl backdrop-blur-md p-6 border border-white/20 rounded-2xl">
                        <!-- Dashboard Mockup Element -->
                        <div class="flex justify-between items-center mb-4 pb-4 border-white/10 border-b">
                            <div class="flex gap-2">
                                <div class="bg-red-400 rounded-full w-3 h-3"></div>
                                <div class="bg-yellow-400 rounded-full w-3 h-3"></div>
                                <div class="bg-green-400 rounded-full w-3 h-3"></div>
                            </div>
                            <div class="font-mono text-white/60 text-xs">dashboard_overview.ui</div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 bg-white/5 p-4 border border-white/5 rounded-lg h-24">
                                <div
                                    class="flex justify-center items-center bg-accent/20 rounded-full w-12 h-12 text-accent">
                                    <i class="text-2xl ph ph-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="bg-white/20 mb-2 rounded w-32 h-4"></div>
                                    <div class="bg-white/10 rounded w-20 h-3"></div>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="flex flex-col flex-1 justify-end bg-white/5 p-4 border border-white/5 rounded-lg h-32">
                                    <div class="bg-white/20 mb-2 rounded w-3/4 h-3"></div>
                                    <div class="bg-white/10 rounded w-1/2 h-2"></div>
                                </div>
                                <div
                                    class="flex flex-col flex-1 justify-end bg-white/5 p-4 border border-white/5 rounded-lg h-32">
                                    <div class="bg-white/20 mb-2 rounded w-2/3 h-3"></div>
                                    <div class="bg-white/10 rounded w-1/3 h-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Quick Status Banner -->
    <div class="z-20 relative mx-auto -mt-8 px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div
            class="gap-4 grid grid-cols-2 md:grid-cols-4 bg-white shadow-lg p-6 border border-gray-100 rounded-2xl divide-x divide-gray-100 text-center">
            <div class="px-4">
                <p class="mb-1 text-gray-500 text-sm">Status Lab Hari Ini</p>
                <p class="flex justify-center items-center gap-2 font-bold text-green-500 text-xl">
                    <span class="bg-green-500 rounded-full w-2 h-2"></span> Buka
                </p>
            </div>
            <div class="px-4">
                <p class="mb-1 text-gray-500 text-sm">Ruang Tersedia</p>
                <p class="font-bold text-gray-800 text-xl">2 Ruang</p>
            </div>
            <div class="px-4">
                <p class="mb-1 text-gray-500 text-sm">Event Terdekat</p>
                <p class="font-bold text-primary text-xl truncate">Workshop AI</p>
            </div>
            <div class="px-4">
                <p class="mb-1 text-gray-500 text-sm">Anggota Aktif</p>
                <p class="font-bold text-gray-800 text-xl">250+ Mhs</p>
            </div>
        </div>
    </div>

    <!-- Laboratorium Section -->
    <section id="laboratorium" class="py-20">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="mb-16 text-center">
                <div class="flex justify-center items-center gap-3 mb-4">
                    <img src="{{ asset('logo_lab_if.png') }}" alt="Logo Lab"
                        class="shadow-sm border border-gray-200 rounded-full w-10 h-10 object-cover">
                    <h2 class="font-bold text-primary text-3xl">Laboratorium Teknik Informatika</h2>
                </div>
                <p class="mx-auto max-w-2xl text-gray-600">Kelola peminjaman alat, ruang, dan pantau jadwal penggunaan
                    laboratorium secara real-time tanpa ribet birokrasi manual.</p>
            </div>

            <div class="gap-8 grid grid-cols-1 md:grid-cols-3">
                <!-- Card 1 -->
                <div
                    class="group bg-white shadow-sm hover:shadow-xl p-8 border border-gray-100 rounded-2xl transition-shadow">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary mb-6 rounded-xl w-14 h-14 text-primary group-hover:text-white text-3xl transition-colors">
                        <i class="ph ph-calendar-blank"></i>
                    </div>
                    <h3 class="mb-3 font-bold text-gray-800 text-xl">Jadwal & Ruangan</h3>
                    <p class="mb-6 text-gray-600 text-sm line-clamp-3">Pantau kalender mingguan penggunaan lab. Lihat
                        slot kosong untuk praktikum, riset, atau kegiatan himpunan.</p>
                    <a href="{{ route('jadwal_lab') }}"
                        class="flex items-center gap-1 hover:gap-2 font-semibold text-primary text-sm transition-all">
                        Lihat Jadwal <i class="ph-arrow-right ph"></i>
                    </a>
                </div>

                <!-- Card 2 -->
                <div
                    class="group relative bg-white shadow-sm hover:shadow-xl p-8 border border-gray-100 rounded-2xl overflow-hidden transition-shadow">
                    <!-- Highlight Badge -->
                    <div
                        class="top-0 right-0 absolute bg-accent px-3 py-1 rounded-bl-xl font-bold text-primary text-xs">
                        Banyak Digunakan</div>

                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary mb-6 rounded-xl w-14 h-14 text-primary group-hover:text-white text-3xl transition-colors">
                        <i class="ph ph-laptop"></i>
                    </div>
                    <h3 class="mb-3 font-bold text-gray-800 text-xl">Peminjaman Inventaris</h3>
                    <p class="mb-6 text-gray-600 text-sm line-clamp-3">Ajukan peminjaman alat seperti proyektor,
                        arduino, kabel, atau PC lab dengan alur persetujuan digital yang transparan.</p>
                    <a href="{{ route('pinjam_alat') }}"
                        class="flex items-center gap-1 hover:gap-2 font-semibold text-primary text-sm transition-all">
                        Pinjam Sekarang <i class="ph-arrow-right ph"></i>
                    </a>
                </div>

                <!-- Card 3 -->
                <div
                    class="group bg-white shadow-sm hover:shadow-xl p-8 border border-gray-100 rounded-2xl transition-shadow">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary mb-6 rounded-xl w-14 h-14 text-primary group-hover:text-white text-3xl transition-colors">
                        <i class="ph ph-wrench"></i>
                    </div>
                    <h3 class="mb-3 font-bold text-gray-800 text-xl">Laporan Kerusakan</h3>
                    <p class="mb-6 text-gray-600 text-sm line-clamp-3">Temukan alat yang rusak saat praktikum? Laporkan
                        langsung melalui portal agar segera ditindaklanjuti oleh laboran.</p>
                    <a href="{{ route('lapor') }}"
                        class="flex items-center gap-1 hover:gap-2 font-semibold text-primary text-sm transition-all">
                        Buat Laporan <i class="ph-arrow-right ph"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Actions Banner Lab -->
            <div
                class="relative flex md:flex-row flex-col justify-between items-center gap-6 bg-primary mt-12 p-8 sm:p-10 rounded-2xl overflow-hidden">
                <div class="top-0 right-0 absolute opacity-10">
                    <i class="text-[200px] -translate-y-10 translate-x-10 ph ph-flask"></i>
                </div>
                <div class="z-10 relative md:text-left text-center">
                    <h4 class="mb-2 font-bold text-white text-2xl">Butuh Panduan Penggunaan Lab?</h4>
                    <p class="text-blue-200">Baca SOP peminjaman dan tata tertib laboratorium sebelum mengajukan.</p>
                </div>
                <button
                    class="z-10 relative bg-white hover:bg-gray-50 shadow px-6 py-3 rounded-xl font-semibold text-primary whitespace-nowrap transition-colors">
                    Unduh SOP PDF
                </button>
            </div>
        </div>
    </section>

    <!-- HIMATIKA Section -->
    <section id="himatika" class="bg-white py-20 border-gray-200 border-t">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex md:flex-row flex-col justify-between items-end gap-4 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ asset('himatika_logo.png') }}" alt="Logo HIMA"
                            class="shadow-sm border border-gray-200 rounded-full w-10 h-10 object-cover">
                        <h2 class="font-bold text-primary text-3xl">Portal HIMATIKA</h2>
                    </div>
                    <p class="max-w-xl text-gray-600">Ikuti perkembangan terbaru, program kerja, dan jadilah bagian dari
                        keluarga besar Himpunan Mahasiswa Teknik Informatika.</p>
                </div>
                <a href="{{ route('berita') }}"
                    class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg font-medium text-gray-700 text-sm whitespace-nowrap transition-colors">
                    Lihat Semua Berita <i class="ph-arrow-up-right ph"></i>
                </a>
            </div>

            <!-- News & Events Grid -->
            <div class="gap-6 grid grid-cols-1 md:grid-cols-4">
                <!-- Main Feature News (Takes 2 cols) -->
                <div class="group relative md:col-span-2 rounded-2xl overflow-hidden cursor-pointer">
                    <img src="https://placehold.co/800x600/1E3A8A/FFFFFF?text=Workshop+Web+Development"
                        alt="Berita Utama"
                        class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                    <div class="bottom-0 left-0 absolute p-6 w-full">
                        <div class="flex gap-2 mb-3">
                            <span class="bg-accent px-2 py-1 rounded font-bold text-primary text-xs">Event</span>
                            <span class="bg-black/50 backdrop-blur-sm px-2 py-1 rounded text-white text-xs">Hari
                                ini</span>
                        </div>
                        <h3 class="mb-2 font-bold text-white group-hover:text-accent text-2xl transition-colors">
                            Workshop Modern Web Development bersama Praktisi Industri</h3>
                        <p class="mb-4 text-gray-300 text-sm line-clamp-2">Tingkatkan skill coding kamu dengan mengikuti
                            workshop intensif yang diadakan oleh Divisi Ristek HIMATIKA.</p>
                        <a href="{{ route('berita') }}" class="flex items-center gap-1 font-medium text-white text-sm">Baca selengkapnya <i
                                class="ph-arrow-right ph"></i></a>
                    </div>
                </div>

                <!-- Secondary News 1 -->
                <div
                    class="group flex flex-col bg-neutralBg hover:shadow-md border border-gray-100 rounded-2xl overflow-hidden transition-all cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://placehold.co/400x300/FBBF24/1E3A8A?text=Open+Recruitment" alt="Berita 2"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col flex-grow p-5">
                        <span class="mb-2 font-bold text-primary text-xs uppercase tracking-wider">Pengumuman</span>
                        <h3 class="mb-2 font-bold text-gray-800 group-hover:text-primary text-lg line-clamp-2">Open
                            Recruitment Pengurus HIMATIKA Periode 2026/2027</h3>
                        <p class="flex-grow mb-4 text-gray-600 text-sm line-clamp-2">Ayo bergabung dan kembangkan
                            potensi leadership kamu bersama himpunan!</p>
                        <span class="flex items-center gap-1 text-gray-400 text-xs"><i class="ph ph-calendar"></i> 10
                            Agustus 2026</span>
                    </div>
                </div>

                <!-- Secondary News 2 -->
                <div
                    class="group flex flex-col bg-neutralBg hover:shadow-md border border-gray-100 rounded-2xl overflow-hidden transition-all cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://placehold.co/400x300/3B82F6/FFFFFF?text=Lomba+Esports" alt="Berita 3"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col flex-grow p-5">
                        <span class="mb-2 font-bold text-primary text-xs uppercase tracking-wider">Minat Bakat</span>
                        <h3 class="mb-2 font-bold text-gray-800 group-hover:text-primary text-lg line-clamp-2">
                            Pendaftaran Turnamen Mobile Legends Antar Angkatan</h3>
                        <p class="flex-grow mb-4 text-gray-600 text-sm line-clamp-2">Buktikan angkatanmu yang terbaik di
                            ajang E-Sports IF tahunan.</p>
                        <span class="flex items-center gap-1 text-gray-400 text-xs"><i class="ph ph-calendar"></i> 05
                            Agustus 2026</span>
                    </div>
                </div>
            </div>

            <!-- HIMATIKA Features Row -->
            <div class="gap-4 grid grid-cols-2 md:grid-cols-4 mt-8">
                <a href="{{ route('anggota') }}"
                    class="group flex items-center gap-4 bg-white hover:shadow-sm p-4 border border-gray-200 hover:border-primary rounded-xl transition-all">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary rounded-full w-10 h-10 text-primary group-hover:text-white text-xl transition-colors">
                        <i class="ph ph-users"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 group-hover:text-primary text-sm">Profil Kami</h4>
                        <p class="text-gray-500 text-xs">Struktur & Visi Misi</p>
                    </div>
                </a>
                <a href="{{ route('galeri') }}"
                    class="group flex items-center gap-4 bg-white hover:shadow-sm p-4 border border-gray-200 hover:border-primary rounded-xl transition-all">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary rounded-full w-10 h-10 text-primary group-hover:text-white text-xl transition-colors">
                        <i class="ph ph-images"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 group-hover:text-primary text-sm">Galeri</h4>
                        <p class="text-gray-500 text-xs">Dokumentasi Acara</p>
                    </div>
                </a>
                <a href="{{ route('berita') }}"
                    class="group flex items-center gap-4 bg-white hover:shadow-sm p-4 border border-gray-200 hover:border-primary rounded-xl transition-all">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary rounded-full w-10 h-10 text-primary group-hover:text-white text-xl transition-colors">
                        <i class="ph ph-chart-bar"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 group-hover:text-primary text-sm">Polling</h4>
                        <p class="text-gray-500 text-xs">Suarakan Pendapatmu</p>
                    </div>
                </a>
                <a href="{{ route('anggota') }}"
                    class="group flex items-center gap-4 bg-white hover:shadow-sm p-4 border border-gray-200 hover:border-primary rounded-xl transition-all">
                    <div
                        class="flex justify-center items-center bg-blue-50 group-hover:bg-primary rounded-full w-10 h-10 text-primary group-hover:text-white text-xl transition-colors">
                        <i class="ph ph-pencil-simple-line"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 group-hover:text-primary text-sm">Daftar Anggota</h4>
                        <p class="text-gray-500 text-xs">Registrasi Online</p>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12 md:py-16 border-accent border-t-4 text-gray-300">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="gap-10 grid grid-cols-1 md:grid-cols-4">
                <!-- Brand Info -->
                <div class="md:col-span-2 pr-0 md:pr-10">
                    <div class="flex items-center gap-4 mb-6">
                        <!-- Dummy Logos Footer -->
                        <div
                            class="flex items-center gap-2 bg-white/10 backdrop-blur-sm p-1.5 border border-white/10 rounded-full">
                            <img src="{{ asset('ubhara_logo.png') }}" alt="Logo Ubhara" class="shadow-sm rounded-full w-9 h-9">
                            <img src="{{ asset('logo_lab_if.png') }}" alt="Logo Lab" class="shadow-sm rounded-full w-9 h-9">
                            <img src="{{ asset('himatika_logo.png') }}" alt="Logo HIMA" class="shadow-sm rounded-full w-9 h-9">
                        </div>
                        <div>
                            <h2 class="font-bold text-white text-xl leading-tight">Portal Informatika Ubhara</h2>
                            <p class="font-medium text-gray-400 text-xs">Universitas Bhayangkara Surabaya</p>
                        </div>
                    </div>
                    <p class="mb-6 text-gray-400 text-sm leading-relaxed">
                        Platform terintegrasi pusat informasi dan layanan Laboratorium Teknik Informatika serta website
                        resmi Himpunan Mahasiswa Teknik Informatika (HIMATIKA).
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="flex justify-center items-center bg-gray-800 hover:bg-primary rounded-full w-10 h-10 hover:text-white transition-colors"><i
                                class="text-xl ph ph-instagram-logo"></i></a>
                        <a href="#"
                            class="flex justify-center items-center bg-gray-800 hover:bg-primary rounded-full w-10 h-10 hover:text-white transition-colors"><i
                                class="text-xl ph ph-youtube-logo"></i></a>
                        <a href="#"
                            class="flex justify-center items-center bg-gray-800 hover:bg-primary rounded-full w-10 h-10 hover:text-white transition-colors"><i
                                class="text-xl ph ph-envelope-simple"></i></a>
                    </div>
                </div>

                <!-- Links Lab -->
                <div>
                    <h3 class="mb-4 font-bold text-white text-sm uppercase tracking-wider">Laboratorium</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#laboratorium" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Dashboard Lab</a></li>
                        <li><a href="{{ route('pinjam_alat') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Peminjaman Inventaris</a></li>
                        <li><a href="{{ route('jadwal_lab') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Jadwal Ruangan</a></li>
                        <li><a href="{{ route('lapor') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Lapor Kerusakan</a></li>
                        <li><a href="{{ route('beranda') }}#laboratorium" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> SOP & Tata Tertib</a></li>
                    </ul>
                </div>

                <!-- Links HIMATIKA -->
                <div>
                    <h3 class="mb-4 font-bold text-white text-sm uppercase tracking-wider">HIMATIKA</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#himatika" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Profil Organisasi</a></li>
                        <li><a href="{{ route('berita') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Galeri Kegiatan</a></li>
                        <li><a href="{{ route('anggota') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Pendaftaran Anggota</a></li>
                        <li><a href="{{ route('berita') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Polling & Suara</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="flex md:flex-row flex-col justify-between items-center gap-4 mt-12 pt-8 border-gray-800 border-t text-sm md:text-left text-center">
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
            // Mobile Menu Toggle Logic
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuIcon = mobileMenuBtn ? mobileMenuBtn.querySelector('i') : null;

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('open');

                    // Change icon based on state
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

            // Add simple scroll effect to header
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
    </script>
</body>

</html>
