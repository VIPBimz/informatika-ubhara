<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - Portal IF Ubhara</title>

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

        /* Filter Button Active State */
        .filter-active {
            background-color: #1E3A8A;
            color: white;
            border-color: #1E3A8A;
            box-shadow: 0 4px 6px -1px rgba(30, 58, 138, 0.1), 0 2px 4px -1px rgba(30, 58, 138, 0.06);
        }

        /* Profile Card Hover effect */
        .profile-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
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
                    <a href="{{ route('beranda') }}"
                        class="text-gray-600 hover:text-primary font-medium px-1 py-2 transition-colors">Beranda</a>

                    <!-- Lab Dropdown -->
                    <div class="group relative">
                        <a href="{{ url('/#laboratorium') }}"
                            class="text-gray-600 hover:text-primary font-medium px-1 py-2 flex items-center gap-1 transition-colors">
                            Laboratorium <i class="ph ph-caret-down text-sm"></i>
                        </a>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('jadwal_lab') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Jadwal
                                    Lab</a>
                                <a href="{{ route('pinjam_alat') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Peminjaman
                                    Alat</a>
                                <a href="{{ route('lapor') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Lapor
                                    Kerusakan</a>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <a href="{{ url('/#himatika') }}"
                            class="text-gray-600 hover:text-primary font-medium px-1 py-2 flex items-center gap-1 transition-colors">
                            HIMATIKA <i class="ph ph-caret-down text-sm"></i>
                        </a>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <div class="py-2">
                                <a href="{{ route('berita') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Berita
                                    & Acara</a>
                                <a href="{{ route('galeri') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-neutralBg hover:text-primary">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('anggota') }}"
                        class="text-primary font-semibold border-b-2 border-accent px-1 py-2">Anggota</a>
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

    <section class="pt-28 pb-12 md:pt-32 md:pb-16 hero-pattern border-b-4 border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-sm font-medium backdrop-blur-sm text-white mb-4">
                <i class="ph ph-users-three text-accent"></i> Kepengurusan & Keanggotaan
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Direktori <span
                    class="text-accent">Anggota</span></h1>
            <p class="text-blue-100 max-w-2xl mx-auto text-sm md:text-base">
                Kenali lebih dekat jajaran pengurus HIMATIKA, asisten laboratorium, dan para anggota aktif Teknik
                Informatika Universitas Bhayangkara Surabaya.
            </p>
        </div>
    </section>

    <section class="py-10 flex-grow bg-neutralBg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Category Filters -->
            <div class="flex flex-wrap items-center justify-center gap-3 mb-12">
                <button
                    class="filter-btn filter-active px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-all shadow-sm flex items-center gap-2"
                    data-filter="all">
                    <i class="ph ph-squares-four"></i> Semua
                </button>
                <button
                    class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-all shadow-sm flex items-center gap-2"
                    data-filter="hima">
                    <i class="ph ph-users"></i> Pengurus HIMATIKA
                </button>
                <button
                    class="filter-btn bg-white text-gray-600 hover:bg-gray-50 px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-200 transition-all shadow-sm flex items-center gap-2"
                    data-filter="lab">
                    <i class="ph ph-flask"></i> Asisten Laboratorium
                </button>
            </div>

            <!-- Members Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="members-grid">

                <!-- Member 1 (HIMA) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="hima">
                    <div class="h-20 bg-gradient-to-r from-blue-700 to-primary"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        HIMATIKA
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/1E3A8A?text=BS" alt="Budi Santoso"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Budi Santoso</h3>
                            <p class="text-primary text-sm font-semibold mb-1">Ketua HIMATIKA</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2023 • 1904111001</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-envelope-simple text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-pink-600 transition-colors"><i
                                        class="ph ph-instagram-logo text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 2 (LAB) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="lab">
                    <div class="h-20 bg-gradient-to-r from-yellow-500 to-accent"></div>
                    <div
                        class="absolute top-4 right-4 bg-black/10 backdrop-blur-sm border border-black/10 text-yellow-900 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        LABORATORIUM
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/F59E0B?text=SA" alt="Siti Aminah"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Siti Aminah</h3>
                            <p class="text-yellow-600 text-sm font-semibold mb-1">Koordinator Asisten Lab</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2022 • 1904110998</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-github-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-envelope-simple text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 3 (HIMA) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="hima">
                    <div class="h-20 bg-gradient-to-r from-blue-700 to-primary"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        HIMATIKA
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/1E3A8A?text=AW" alt="Andi Wijaya"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Andi Wijaya</h3>
                            <p class="text-primary text-sm font-semibold mb-1">Ketua Divisi Ristek</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2024 • 1904111050</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-github-logo text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 4 (LAB) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="lab">
                    <div class="h-20 bg-gradient-to-r from-yellow-500 to-accent"></div>
                    <div
                        class="absolute top-4 right-4 bg-black/10 backdrop-blur-sm border border-black/10 text-yellow-900 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        LABORATORIUM
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/F59E0B?text=DP" alt="Dinda Putri"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Dinda Putri</h3>
                            <p class="text-yellow-600 text-sm font-semibold mb-1">Asisten Lab Jaringan</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2023 • 1904111015</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-envelope-simple text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 5 (HIMA) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="hima">
                    <div class="h-20 bg-gradient-to-r from-blue-700 to-primary"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        HIMATIKA
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/1E3A8A?text=MS" alt="Maya Sari"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Maya Sari</h3>
                            <p class="text-primary text-sm font-semibold mb-1">Bendahara Umum</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2023 • 1904111005</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-pink-600 transition-colors"><i
                                        class="ph ph-instagram-logo text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 6 (HIMA) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="hima">
                    <div class="h-20 bg-gradient-to-r from-blue-700 to-primary"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        HIMATIKA
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/1E3A8A?text=RM" alt="Riko Maulana"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Riko Maulana</h3>
                            <p class="text-primary text-sm font-semibold mb-1">Staff Div. Eksternal</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2024 • 1904111080</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 7 (LAB) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="lab">
                    <div class="h-20 bg-gradient-to-r from-yellow-500 to-accent"></div>
                    <div
                        class="absolute top-4 right-4 bg-black/10 backdrop-blur-sm border border-black/10 text-yellow-900 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        LABORATORIUM
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/F59E0B?text=KA" alt="Kevin Aprilio"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Kevin Aprilio</h3>
                            <p class="text-yellow-600 text-sm font-semibold mb-1">Asisten Lab Multimedia</p>
                            <p class="text-gray-400 text-xs mb-4">Angkatan 2024 • 1904111075</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-github-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-envelope-simple text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member 8 (LAB) -->
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden profile-card member-card relative"
                    data-category="lab">
                    <div class="h-20 bg-gradient-to-r from-yellow-500 to-accent"></div>
                    <div
                        class="absolute top-4 right-4 bg-black/10 backdrop-blur-sm border border-black/10 text-yellow-900 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                        LABORATORIUM
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-10 mb-4">
                            <img src="https://placehold.co/200x200/F3F4F6/F59E0B?text=RF" alt="Reza Fahlevi"
                                class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-sm bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">Reza Fahlevi</h3>
                            <p class="text-yellow-600 text-sm font-semibold mb-1">Laboran / Admin Lab</p>
                            <p class="text-gray-400 text-xs mb-4">Staff Karyawan Tetap</p>

                            <div class="flex justify-center gap-3 pt-4 border-t border-gray-100">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                                        class="ph ph-linkedin-logo text-xl"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-800 transition-colors"><i
                                        class="ph ph-envelope-simple text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Registration CTA Section -->
            <div
                class="mt-16 bg-gradient-to-br from-primary to-blue-900 rounded-3xl p-8 md:p-12 text-center text-white shadow-xl relative overflow-hidden border border-blue-800">
                <div
                    class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')]">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik Bergabung Bersama Kami?</h2>
                    <p class="text-blue-100 mb-8 text-sm md:text-base">
                        Kembangkan minat, bakat, dan pengalaman organisasimu dengan menjadi bagian dari keluarga besar
                        HIMATIKA atau tingkatkan skill teknismu dengan menjadi Asisten Laboratorium.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button
                            class="bg-accent text-primary px-8 py-3.5 rounded-xl font-bold hover:bg-yellow-300 transition-colors shadow-lg flex items-center justify-center gap-2">
                            <i class="ph ph-user-plus text-xl"></i> Daftar HIMATIKA
                        </button>
                        <button
                            class="bg-white/10 border border-white/30 text-white px-8 py-3.5 rounded-xl font-bold hover:bg-white/20 backdrop-blur-sm transition-colors shadow-lg flex items-center justify-center gap-2">
                            <i class="ph ph-student text-xl"></i> Rekrutmen Asisten Lab
                        </button>
                    </div>
                    <p class="text-xs text-blue-300 mt-4"><i class="ph ph-info"></i> Pendaftaran akan dibuka pada awal
                        semester ganjil.</p>
                </div>
            </div>

        </div>
    </section>

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
                        Platform terintegrasi pusat informasi dan layanan Laboratorium Teknik Informatika serta website
                        resmi Himpunan Mahasiswa Teknik Informatika (HIMATIKA).
                    </p>
                </div>

                <!-- Links Lab -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Laboratorium</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('jadwal_lab') }}"
                                class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Jadwal Ruangan</a></li>
                        <li><a href="{{ route('pinjam_alat') }}"
                                class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Peminjaman Inventaris</a></li>
                        <li><a href="{{ route('lapor') }}"
                                class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Lapor Kerusakan</a></li>
                        <li><a href="{{ route('beranda') }}#laboratorium" class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> SOP & Tata Tertib</a></li>
                    </ul>
                </div>

                <!-- Links HIMATIKA -->
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">HIMATIKA</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('beranda') }}#himatika" class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Profil Organisasi</a></li>
                        <li><a href="{{ route('berita') }}"
                                class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Galeri Kegiatan</a></li>
                        <li><a href="{{ route('anggota') }}" class="text-accent transition-colors flex items-center gap-2"><i
                                    class="ph ph-caret-right text-xs"></i> Daftar Anggota</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-12 pt-8 border-t border-gray-800 text-sm text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
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

            // Filter Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const memberCards = document.querySelectorAll('.member-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => {
                        b.classList.remove('filter-active');
                        b.classList.add('bg-white', 'text-gray-600');
                    });
                    btn.classList.add('filter-active');
                    btn.classList.remove('bg-white', 'text-gray-600');

                    const filterValue = btn.getAttribute('data-filter');

                    memberCards.forEach(card => {
                        if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
