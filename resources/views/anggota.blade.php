<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Anggota & Personalia - Portal Informatika UBHARA</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
                        primary: '#1E3A8A', // Biru Tua UBHARA
                        accent: '#FBBF24',  // Kuning Cerah Accent
                        neutralBg: '#F3F4F6', // Abu-abu muda
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .hero-pattern {
            background-color: #1E3A8A;
            background-image: radial-gradient(circle at top right, rgba(251, 191, 36, 0.12) 0%, transparent 40%),
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

        /* Filter Button Active State */
        .filter-active {
            background-color: #1E3A8A !important;
            color: white !important;
            border-color: #1E3A8A !important;
            box-shadow: 0 4px 12px -1px rgba(30, 58, 138, 0.25);
        }

        /* Profile Card Hover effect */
        .profile-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px -5px rgba(30, 58, 138, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="flex flex-col justify-between bg-neutralBg min-h-screen font-sans text-gray-800 antialiased">

    <!-- Header Navigation -->
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
                        class="px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">Beranda</a>

                    <!-- Lab Dropdown -->
                    <div class="group relative">
                        <a href="{{ url('/#laboratorium') }}"
                            class="flex items-center gap-1 px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">
                            Laboratorium <i class="text-sm ph ph-caret-down"></i>
                        </a>
                        <div
                            class="invisible group-hover:visible left-0 absolute bg-white opacity-0 group-hover:opacity-100 shadow-lg mt-2 border border-gray-100 rounded-xl w-48 transition-all duration-200">
                            <div class="py-2">
                                <a href="{{ route('jadwal_lab') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Jadwal
                                    Lab</a>
                                <a href="{{ route('pinjam_alat') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Peminjaman
                                    Alat</a>
                                <a href="{{ route('lapor') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Lapor
                                    Kerusakan</a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <a href="{{ url('/#himatika') }}"
                            class="flex items-center gap-1 px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">
                            HIMATIKA <i class="text-sm ph ph-caret-down"></i>
                        </a>
                        <div
                            class="invisible group-hover:visible left-0 absolute bg-white opacity-0 group-hover:opacity-100 shadow-lg mt-2 border border-gray-100 rounded-xl w-48 transition-all duration-200">
                            <div class="py-2">
                                <a href="{{ route('berita') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Berita
                                    & Acara</a>
                                <a href="{{ route('galeri') }}"
                                    class="block hover:bg-neutralBg px-4 py-2 text-gray-700 hover:text-primary text-sm">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('anggota') }}"
                        class="border-accent px-1 py-2 border-b-2 font-semibold text-primary">Anggota</a>
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

    <!-- Hero Banner & Header Title -->
    <section class="border-accent pt-28 md:pt-32 pb-12 md:pb-16 border-b-4 text-center text-white hero-pattern">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm mb-4 px-4 py-1.5 border border-white/20 rounded-full font-medium text-sm text-white">
                <i class="text-accent ph ph-users-three"></i> Kepengurusan & Personalia Terverifikasi
            </div>
            <h1 class="font-bold text-3xl md:text-5xl text-white">
                Direktori <span class="text-accent">Anggota & Pengurus</span>
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-blue-100 text-sm md:text-base">
                Kenali lebih dekat jajaran Dosen Pembina, Asisten Laboratorium, dan Pengurus HIMATIKA Teknik Informatika Universitas Bhayangkara Surabaya.
            </p>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="flex-grow bg-neutralBg py-10">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <!-- Search Bar & Filters -->
            <div class="space-y-6 mb-10">

                <!-- 1. Search Box -->
                <div class="mx-auto max-w-xl">
                    <div class="relative shadow-sm rounded-2xl">
                        <div class="left-0 absolute inset-y-0 flex items-center pl-4 text-gray-400 pointer-events-none">
                            <i class="text-xl ph ph-magnifying-glass"></i>
                        </div>
                        <input type="text" id="search-member" onkeyup="filterMembers()"
                            placeholder="Cari nama anggota, jabatan, NIM/NIDN, atau fokus keahlian..."
                            class="bg-white focus:bg-white py-3.5 pr-4 pl-12 border border-gray-200 focus:border-primary rounded-2xl focus:ring-2 focus:ring-primary/20 w-full font-medium text-sm transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- 2. Category Filter Pills (3 Kategori: Dosen, Aslab, HIMATIKA) -->
                <div class="flex flex-wrap justify-center items-center gap-3">
                    <button
                        class="filter-btn filter-active flex items-center gap-2 bg-white shadow-xs px-6 py-2.5 border border-gray-200 rounded-full font-semibold text-gray-600 text-sm transition-all cursor-pointer"
                        data-filter="all">
                        <i class="ph ph-squares-four"></i> Semua ({{ $stats['total'] ?? 0 }})
                    </button>
                    <button
                        class="filter-btn flex items-center gap-2 bg-white hover:bg-gray-50 shadow-xs px-6 py-2.5 border border-gray-200 rounded-full font-semibold text-gray-600 text-sm transition-all cursor-pointer"
                        data-filter="dosen">
                        <i class="text-emerald-600 ph ph-chalkboard-teacher"></i> Dosen Pembina ({{ $stats['dosen'] ?? 0 }})
                    </button>
                    <button
                        class="filter-btn flex items-center gap-2 bg-white hover:bg-gray-50 shadow-xs px-6 py-2.5 border border-gray-200 rounded-full font-semibold text-gray-600 text-sm transition-all cursor-pointer"
                        data-filter="aslab">
                        <i class="text-amber-500 ph ph-flask"></i> Asisten Laboratorium ({{ $stats['aslab'] ?? 0 }})
                    </button>
                    <button
                        class="filter-btn flex items-center gap-2 bg-white hover:bg-gray-50 shadow-xs px-6 py-2.5 border border-gray-200 rounded-full font-semibold text-gray-600 text-sm transition-all cursor-pointer"
                        data-filter="himatika">
                        <i class="text-blue-500 ph ph-users"></i> Pengurus HIMATIKA ({{ $stats['himatika'] ?? 0 }})
                    </button>
                </div>

            </div>

            <!-- Members Grid Container -->
            <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="members-grid">

                @forelse($members as $member)
                    @php
                        // Banner gradient & badge mapping based on 3 categories
                        $badgeLabel = match($member->kategori) {
                            'dosen' => 'DOSEN PEMBINA',
                            'aslab' => 'ASISTEN LAB',
                            'himatika' => 'PENGURUS HIMATIKA',
                            default => strtoupper(str_replace('_', ' ', $member->kategori))
                        };

                        $headerGradient = match($member->kategori) {
                            'dosen' => 'from-emerald-700 via-teal-800 to-primary',
                            'aslab' => 'from-amber-500 via-yellow-600 to-amber-700',
                            'himatika' => 'from-blue-700 via-indigo-800 to-primary',
                            default => 'from-gray-700 to-gray-900'
                        };

                        // Avatar photo resolver
                        $avatarUrl = $member->foto
                            ? asset('storage/' . $member->foto)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($member->nama) . '&background=1E3A8A&color=FBBF24&bold=true&size=200';
                    @endphp

                    <div class="relative bg-white shadow-xs border border-gray-100 rounded-2xl overflow-hidden profile-card member-card"
                        data-category="{{ $member->kategori }}"
                        data-search="{{ strtolower($member->nama . ' ' . $member->nim_nidn . ' ' . $member->jabatan . ' ' . $member->divisi_keahlian . ' ' . $badgeLabel) }}">

                        <!-- Card Header Gradient Banner -->
                        <div class="h-20 bg-gradient-to-r {{ $headerGradient }}"></div>

                        <!-- Top Right Category Badge -->
                        <div class="top-3 right-3 absolute bg-black/25 backdrop-blur-md px-2.5 py-1 border border-white/20 rounded-md font-bold text-[10px] text-white tracking-wider">
                            {{ $badgeLabel }}
                        </div>

                        <!-- Card Body -->
                        <div class="relative px-6 pb-6">

                            <!-- Avatar -->
                            <div class="flex justify-center -mt-10 mb-3">
                                <img src="{{ $avatarUrl }}" alt="{{ $member->nama }}"
                                    class="bg-white shadow-sm border-4 border-white rounded-full w-20 h-20 object-cover">
                            </div>

                            <!-- Bio Information -->
                            <div class="text-center">
                                <h3 class="font-bold text-base text-gray-800 leading-snug line-clamp-1" title="{{ $member->nama }}">
                                    {{ $member->nama }}
                                </h3>
                                <p class="font-semibold text-primary text-xs mt-0.5 line-clamp-1" title="{{ $member->jabatan }}">
                                    {{ $member->jabatan }}
                                </p>

                                <!-- NIM / Angkatan -->
                                <div class="flex justify-center items-center gap-1.5 mt-1 text-[11px] text-gray-400 font-mono">
                                    @if($member->angkatan)
                                        <span>Angk. {{ $member->angkatan }}</span>
                                        @if($member->nim_nidn) <span>•</span> @endif
                                    @endif
                                    @if($member->nim_nidn)
                                        <span>{{ $member->nim_nidn }}</span>
                                    @endif
                                </div>

                                <!-- Divisi / Keahlian Pill -->
                                @if($member->divisi_keahlian)
                                    <div class="mt-3">
                                        <span class="inline-block bg-gray-100 text-gray-600 text-[11px] px-2.5 py-1 rounded-lg font-medium truncate max-w-full" title="{{ $member->divisi_keahlian }}">
                                            <i class="ph ph-sparkle text-accent mr-1"></i>{{ $member->divisi_keahlian }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Social Links -->
                                <div class="flex justify-center items-center gap-3 mt-4 pt-3.5 border-t border-gray-100">
                                    @if($member->linkedin_url)
                                        <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                            class="text-gray-400 hover:text-blue-600 transition-colors p-1" title="LinkedIn">
                                            <i class="text-lg ph ph-linkedin-logo"></i>
                                        </a>
                                    @endif

                                    @if($member->github_url)
                                        <a href="{{ $member->github_url }}" target="_blank" rel="noopener noreferrer"
                                            class="text-gray-400 hover:text-gray-900 transition-colors p-1" title="GitHub">
                                            <i class="text-lg ph ph-github-logo"></i>
                                        </a>
                                    @endif

                                    @if($member->instagram_url)
                                        <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer"
                                            class="text-gray-400 hover:text-pink-600 transition-colors p-1" title="Instagram">
                                            <i class="text-lg ph ph-instagram-logo"></i>
                                        </a>
                                    @endif

                                    @if($member->email_kontak)
                                        <a href="mailto:{{ $member->email_kontak }}"
                                            class="text-gray-400 hover:text-amber-600 transition-colors p-1" title="Email: {{ $member->email_kontak }}">
                                            <i class="text-lg ph ph-envelope-simple"></i>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-400">
                        <i class="ph ph-user-minus text-4xl text-gray-300 mb-2"></i>
                        <p class="text-sm font-medium">Belum ada data anggota yang dipublikasikan.</p>
                    </div>
                @endforelse

            </div>

            <!-- No Search Results Found Alert -->
            <div id="no-search-results" class="hidden py-16 text-center text-gray-400">
                <i class="ph ph-magnifying-glass text-4xl text-gray-300 mb-2"></i>
                <p class="text-sm font-semibold text-gray-600">Tidak ada anggota yang cocok dengan pencarian.</p>
                <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci lain atau pilih filter kategori "Semua".</p>
            </div>

            <!-- Registration CTA Section -->
            <div
                class="relative bg-gradient-to-br from-primary to-blue-900 shadow-xl mt-16 p-8 md:p-12 border border-blue-800 rounded-3xl overflow-hidden text-center text-white">
                <div
                    class="opacity-10 absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')]">
                </div>

                <div class="z-10 relative mx-auto max-w-2xl">
                    <h2 class="font-bold text-2xl md:text-4xl">Tertarik Bergabung Bersama Kami?</h2>
                    <p class="mt-3 mb-8 text-blue-100 text-xs md:text-sm">
                        Kembangkan minat, bakat, dan pengalaman organisasimu bersama keluarga besar HIMATIKA atau tingkatkan kompetensi teknis dan riset dengan menjadi Asisten Laboratorium Informatika.
                    </p>

                    <div class="flex sm:flex-row flex-col justify-center gap-4">
                        <a href="https://instagram.com/himatika_ubhara" target="_blank"
                            class="flex justify-center items-center gap-2 bg-accent hover:bg-yellow-300 shadow-lg px-8 py-3.5 rounded-xl font-bold text-primary transition-colors">
                            <i class="text-xl ph ph-user-plus"></i> Rekrutmen HIMATIKA
                        </a>
                        <a href="{{ route('berita') }}"
                            class="flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm shadow-lg px-8 py-3.5 border border-white/30 rounded-xl font-bold text-white transition-colors">
                            <i class="text-xl ph ph-student"></i> Info Open Recruitment Aslab
                        </a>
                    </div>
                    <p class="mt-4 text-blue-300 text-xs"><i class="ph ph-info"></i> Pendaftaran dibuka berkala setiap awal semester perkuliahan.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 mt-auto py-12 md:py-16 border-accent border-t-4 text-gray-300">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="gap-10 grid grid-cols-1 md:grid-cols-4">
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
                            <h2 class="font-bold text-white text-xl leading-tight">Portal IF Ubhara</h2>
                            <p class="font-medium text-gray-400 text-xs">Universitas Bhayangkara Surabaya</p>
                        </div>
                    </div>
                    <p class="mb-6 text-gray-400 text-sm leading-relaxed">
                        Platform terintegrasi pusat informasi dan layanan Laboratorium Teknik Informatika serta website
                        resmi Himpunan Mahasiswa Teknik Informatika (HIMATIKA).
                    </p>
                </div>

                <!-- Links Lab -->
                <div>
                    <h3 class="mb-4 font-bold text-white text-sm uppercase tracking-wider">Laboratorium</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('jadwal_lab') }}"
                                class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Jadwal Ruangan</a></li>
                        <li><a href="{{ route('pinjam_alat') }}"
                                class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Peminjaman Inventaris</a></li>
                        <li><a href="{{ route('lapor') }}"
                                class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Lapor Kerusakan</a></li>
                        <li><a href="{{ route('absensi') }}"
                                class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Presensi Mahasiswa</a></li>
                    </ul>
                </div>

                <!-- Links HIMATIKA -->
                <div>
                    <h3 class="mb-4 font-bold text-white text-sm uppercase tracking-wider">HIMATIKA</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#himatika" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Profil Organisasi</a></li>
                        <li><a href="{{ route('berita') }}"
                                class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Galeri Kegiatan</a></li>
                        <li><a href="{{ route('anggota') }}" class="flex items-center gap-2 text-accent transition-colors"><i
                                    class="text-xs ph ph-caret-right"></i> Direktori Anggota</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="flex md:flex-row flex-col justify-between items-center gap-4 mt-12 pt-8 border-gray-800 border-t text-sm md:text-left text-center">
                <p>&copy; {{ date('Y') }} Laboratorium & HIMATIKA Teknik Informatika. Universitas Bhayangkara Surabaya.</p>
                <div class="flex gap-4">
                    <a href="{{ url('/admin/login') }}" class="text-gray-400 hover:text-white transition-colors">Login CMS Pengurus</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive JavaScript -->
    <script>
        let currentFilter = 'all';

        document.addEventListener('DOMContentLoaded', () => {
            setupMobileMenu();
            setupFilters();
        });

        // Setup Category Filter Buttons
        function setupFilters() {
            const filterBtns = document.querySelectorAll('.filter-btn');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => b.classList.remove('filter-active'));
                    btn.classList.add('filter-active');

                    currentFilter = btn.getAttribute('data-filter') || 'all';
                    filterMembers();
                });
            });
        }

        // Live Search & Category Filtering
        function filterMembers() {
            const searchInput = document.getElementById('search-member');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const cards = document.querySelectorAll('.member-card');
            const noResults = document.getElementById('no-search-results');

            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const group = card.getAttribute('data-group');
                const searchData = card.getAttribute('data-search') || '';

                // Category match condition (3 kategori: dosen, aslab, himatika)
                const matchCategory = (currentFilter === 'all' || category === currentFilter);

                // Text search match condition
                const matchSearch = !query || searchData.includes(query);

                if (matchCategory && matchSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noResults) {
                if (visibleCount === 0 && cards.length > 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }
        }

        // Mobile Menu Setup
        function setupMobileMenu() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (!mobileMenuBtn || !mobileMenu) return;
            const mobileMenuIcon = mobileMenuBtn.querySelector('i');

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

            // Close mobile menu on link click
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

            // Header Scroll
            const header = document.querySelector('header');
            if (header) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 20) {
                        header.classList.add('shadow-md');
                        header.classList.remove('shadow-sm');
                    } else {
                        header.classList.remove('shadow-md');
                        header.classList.add('shadow-sm');
                    }
                });
            }
        }
    </script>
</body>

</html>
