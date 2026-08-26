<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Absensi Laboratorium - Portal Informatika UBHARA</title>

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

        /* Scanner laser animation */
        @keyframes scan {
            0% {
                top: 0%;
            }

            50% {
                top: 90%;
            }

            100% {
                top: 0%;
            }
        }

        .scanner-line {
            animation: scan 2.5s ease-in-out infinite;
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

<body class="flex flex-col justify-between bg-neutralBg min-h-screen font-sans text-gray-800 antialiased">

    <!-- Navigation Header -->
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

                    <!-- Lab Dropdown Trigger -->
                    <div class="group relative">
                        <a href="{{ url('/#laboratorium') }}"
                            class="flex items-center gap-1 px-1 py-2 font-medium text-gray-600 hover:text-primary transition-colors">
                            Laboratorium <i class="text-sm ph-caret-down ph"></i>
                        </a>
                        <!-- Dropdown Content -->
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
                            HIMATIKA <i class="text-sm ph-caret-down ph"></i>
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

                    <a href="{{ route('anggota') }}" class="px-1 py-2 font-medium text-gray-600 hover:text-primary">Anggota</a>
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

    <!-- Hero Banner & Page Title -->
    <section class="relative pt-28 pb-10 overflow-hidden text-white hero-pattern">
        <div class="z-10 relative mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex md:flex-row flex-col justify-between items-start md:items-center gap-4">
                <div>
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm mb-2 px-3 py-1 border border-white/20 rounded-full font-medium text-xs">
                        <i class="text-accent ph ph-clipboard-text"></i> Presensi Masuk Laboratorium Terintegrasi
                    </div>
                    <h1 class="font-bold text-2xl md:text-3xl leading-tight">
                        Form Absensi <span class="text-accent">Mahasiswa Lab Informatika</span>
                    </h1>
                    <p class="mt-1 max-w-xl text-blue-100 text-xs md:text-sm">
                        Isikan NIM, Nama, dan Tujuan Anda memasuki laboratorium Teknik Informatika Ubhara Surabaya. Data tersimpan langsung ke sistem CMS.
                    </p>
                </div>
                <!-- Realtime Clock Widget -->
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 border border-white/20 rounded-2xl shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-accent/20 border border-accent/40 flex items-center justify-center text-accent text-xl">
                        <i class="ph ph-clock"></i>
                    </div>
                    <div>
                        <div id="realtime-clock" class="font-mono font-bold text-lg text-white leading-none">--:--:-- WIB</div>
                        <div id="realtime-date" class="text-xs text-blue-200 mt-1">--</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <main class="z-20 relative flex-grow mx-auto -mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full max-w-7xl">
        <div class="gap-8 grid grid-cols-1 lg:grid-cols-12">

            <!-- LEFT COLUMN: Form Absensi (5 cols) -->
            <div class="lg:col-span-5">
                <div class="space-y-5 bg-white shadow-lg p-6 border border-gray-100 rounded-2xl">

                    <div class="pb-4 border-gray-100 border-b">
                        <h2 class="flex items-center gap-2 font-bold text-primary text-lg">
                            <i class="text-accent text-xl ph ph-note-pencil"></i> Input Presensi
                        </h2>
                        <p class="text-gray-500 text-xs">Silakan lengkapi form di bawah ini untuk mencatat kehadiran</p>
                    </div>

                    <form id="attendanceForm" onsubmit="handleFormSubmit(event)" class="space-y-4">
                        @csrf

                        <!-- 1. NIM Field -->
                        <div>
                            <label for="nim"
                                class="block mb-1.5 font-bold text-gray-700 text-xs uppercase tracking-wider">
                                NIM (Nomor Induk Mahasiswa) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative shadow-xs rounded-xl">
                                <div
                                    class="left-0 absolute inset-y-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="text-lg ph ph-identification-card"></i>
                                </div>
                                <input type="text" id="nim" name="nim" required placeholder="Contoh: 2212001"
                                    class="bg-gray-50 focus:bg-white py-3 pr-4 pl-10 border border-gray-200 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 w-full font-mono font-medium text-sm transition-all">
                            </div>
                        </div>

                        <!-- 2. Nama Mahasiswa Field -->
                        <div>
                            <label for="nama"
                                class="block mb-1.5 font-bold text-gray-700 text-xs uppercase tracking-wider">
                                Nama Lengkap Mahasiswa <span class="text-red-500">*</span>
                            </label>
                            <div class="relative shadow-xs rounded-xl">
                                <div
                                    class="left-0 absolute inset-y-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="text-lg ph ph-user"></i>
                                </div>
                                <input type="text" id="nama" name="nama" required placeholder="Contoh: Bima Arya Pangestu"
                                    class="bg-gray-50 focus:bg-white py-3 pr-4 pl-10 border border-gray-200 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 w-full font-medium text-sm transition-all">
                            </div>
                        </div>

                        <!-- 3. Pilih Ruangan Lab (Opsional) -->
                        <div>
                            <label for="lab_id"
                                class="block mb-1.5 font-bold text-gray-700 text-xs uppercase tracking-wider">
                                Ruangan Laboratorium (Opsional)
                            </label>
                            <div class="relative shadow-xs rounded-xl">
                                <div
                                    class="left-0 absolute inset-y-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="text-lg ph ph-building-office"></i>
                                </div>
                                <select id="lab_id" name="lab_id"
                                    class="bg-gray-50 focus:bg-white py-3 pr-4 pl-10 border border-gray-200 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 w-full font-medium text-sm transition-all appearance-none cursor-pointer">
                                    <option value="">-- Umum / Semua Ruangan --</option>
                                    @isset($labs)
                                        @foreach($labs as $lab)
                                            <option value="{{ $lab->id }}">{{ $lab->nama }} ({{ $lab->kode }})</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <div class="right-0 absolute inset-y-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                                    <i class="text-sm ph ph-caret-down"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Tujuan (Text) Field -->
                        <div>
                            <label for="tujuan"
                                class="block mb-1.5 font-bold text-gray-700 text-xs uppercase tracking-wider">
                                Tujuan Masuk Lab <span class="text-red-500">*</span>
                            </label>
                            <div class="relative shadow-xs rounded-xl">
                                <div
                                    class="left-0 absolute inset-y-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="text-lg ph ph-target"></i>
                                </div>
                                <input type="text" id="tujuan" name="tujuan" required
                                    placeholder="Contoh: Praktikum Pemrograman Web / Riset Skripsi"
                                    class="bg-gray-50 focus:bg-white py-3 pr-4 pl-10 border border-gray-200 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 w-full font-medium text-sm transition-all">
                            </div>
                        </div>

                        <!-- 5. Tombol Absensi -->
                        <button type="submit" id="submitBtn"
                            class="group flex justify-center items-center gap-2 bg-primary hover:bg-blue-900 shadow-md hover:shadow-lg mt-2 px-6 py-3.5 rounded-xl w-full font-bold text-white text-base transition-all cursor-pointer">
                            <span id="btnIcon"><i class="text-accent text-xl group-hover:scale-110 transition-transform ph ph-check-circle"></i></span>
                            <span id="btnText">Simpan Absensi</span>
                        </button>

                    </form>

                </div>
            </div>

            <!-- RIGHT COLUMN: List Mahasiswa Absensi (7 cols) -->
            <div id="daftar-absen" class="space-y-4 lg:col-span-7">

                <div class="space-y-4 bg-white shadow-lg p-6 border border-gray-100 rounded-2xl">

                    <!-- Card Header: Title & Counter Badge -->
                    <div
                        class="flex sm:flex-row flex-col justify-between items-start sm:items-center gap-3 pb-4 border-gray-100 border-b">
                        <div>
                            <h2 class="flex items-center gap-2 font-bold text-gray-800 text-lg">
                                <i class="text-primary text-xl ph ph-users-three"></i> Daftar Hadir Hari Ini
                            </h2>
                            <p class="text-gray-500 text-xs">Riwayat kehadiran mahasiswa di laboratorium per {{ date('d M Y') }}</p>
                        </div>

                        <!-- 2. Jumlah Mahasiswa Absen Badge -->
                        <div
                            class="flex items-center gap-2 bg-blue-50 px-3.5 py-1.5 border border-blue-100 rounded-xl font-bold text-primary text-xs shrink-0">
                            <i class="text-accent text-base ph ph-user-check"></i>
                            Total Absen: <span id="total-count-badge"
                                class="font-extrabold text-primary text-sm">{{ $todayCount ?? 0 }}</span> Mahasiswa
                        </div>
                    </div>

                    <!-- 1. Search Bar -->
                    <div class="relative">
                        <i class="top-3 left-3.5 absolute text-gray-400 text-base ph ph-magnifying-glass"></i>
                        <input type="text" id="search-input" onkeyup="filterStudents()"
                            placeholder="Cari berdasarkan Nama, NIM, Lab, atau Tujuan..."
                            class="bg-gray-50 focus:bg-white py-2.5 pr-4 pl-10 border border-gray-200 focus:border-primary rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 w-full font-medium text-xs transition-all">
                    </div>

                    <!-- 3. List Mahasiswa dan Jam Masuk -->
                    <div id="students-list" class="space-y-3 pr-1 max-h-[480px] overflow-y-auto">
                        @if(isset($attendances) && $attendances->count() > 0)
                            @foreach($attendances as $index => $item)
                                <div class="student-item p-4 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-blue-200 transition-all shadow-2xs space-y-1.5"
                                    data-search="{{ strtolower($item->nama . ' ' . $item->nim . ' ' . ($item->lab ? $item->lab->nama : '') . ' ' . $item->tujuan) }}">
                                    <div class="flex justify-between items-center gap-3">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="flex justify-center items-center bg-primary/10 border border-primary/20 rounded-lg w-8 h-8 font-bold text-primary text-xs shrink-0 item-number">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="min-w-0">
                                                <h4 class="font-bold text-gray-800 text-sm truncate">{{ $item->nama }}</h4>
                                                <span class="font-mono font-semibold text-primary text-xs">{{ $item->nim }}</span>
                                                @if($item->lab)
                                                    <span class="ml-2 inline-flex items-center bg-blue-100 text-blue-800 text-[10px] font-medium px-2 py-0.5 rounded-full">
                                                        {{ $item->lab->kode }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 px-2.5 py-1 border border-emerald-200 rounded-lg font-mono font-bold text-emerald-700 text-xs shrink-0">
                                            <i class="text-sm ph ph-clock"></i> {{ substr($item->jam_masuk, 0, 5) }} WIB
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1.5 pt-1.5 border-gray-200/60 border-t text-gray-600 text-xs">
                                        <i class="text-gray-400 ph ph-subtitles"></i>
                                        <span class="font-medium text-gray-700">Tujuan:</span>
                                        <span class="text-gray-600 truncate">{{ $item->tujuan }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div id="empty-state" class="py-10 text-gray-400 text-xs text-center">
                                <i class="block mb-1 text-gray-300 text-3xl ph ph-clipboard"></i>
                                Belum ada data mahasiswa yang melakukan absensi hari ini.
                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- Success Toast Notification -->
    <div id="toast-notify"
        class="right-5 bottom-5 z-50 fixed opacity-0 transition-all translate-y-20 duration-300 pointer-events-none transform">
        <div id="toast-card"
            class="flex items-center gap-3 bg-gray-900 shadow-2xl px-5 py-3.5 border border-gray-700 rounded-2xl text-white">
            <div id="toast-icon"
                class="flex justify-center items-center bg-emerald-500/20 rounded-xl w-8 h-8 text-emerald-400 text-xl shrink-0">
                <i class="ph ph-check-bold"></i>
            </div>
            <div>
                <h5 id="toast-title" class="font-bold text-white text-xs">Absensi Berhasil!</h5>
                <p id="toast-msg" class="text-[11px] text-gray-300">Data presensi telah tersimpan ke database.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12 md:py-16 border-accent border-t-4 text-gray-300">
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
                            <h2 class="font-bold text-white text-xl leading-tight">Portal Informatika Ubhara</h2>
                            <p class="font-medium text-gray-400 text-xs">Universitas Bhayangkara Surabaya</p>
                        </div>
                    </div>
                    <p class="mb-6 text-gray-400 text-sm leading-relaxed">
                        Platform terintegrasi pusat informasi dan layanan Laboratorium Teknik Informatika serta website
                        resmi Himpunan Mahasiswa Teknik Informatika (HIMATIKA).
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://instagram.com/himatika_ubhara" target="_blank"
                            class="flex justify-center items-center bg-gray-800 hover:bg-primary rounded-full w-10 h-10 hover:text-white transition-colors"><i
                                class="text-xl ph ph-instagram-logo"></i></a>
                        <a href="https://youtube.com/@himatikaubhara" target="_blank"
                            class="flex justify-center items-center bg-gray-800 hover:bg-primary rounded-full w-10 h-10 hover:text-white transition-colors"><i
                                class="text-xl ph ph-youtube-logo"></i></a>
                        <a href="mailto:lab.informatika@ubhara.ac.id"
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
                        <li><a href="{{ route('absensi') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Absensi Mahasiswa</a></li>
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
                                    class="text-xs ph-caret-right ph"></i> Personalia & Anggota</a></li>
                        <li><a href="{{ url('/admin/login') }}" class="flex items-center gap-2 hover:text-accent transition-colors"><i
                                    class="text-xs ph-caret-right ph"></i> Login CMS Pengurus</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="flex md:flex-row flex-col justify-between items-center gap-4 mt-12 pt-8 border-gray-800 border-t text-sm md:text-left text-center">
                <p>&copy; {{ date('Y') }} Laboratorium & HIMATIKA Teknik Informatika. Universitas Bhayangkara Surabaya.</p>
                <div class="flex gap-4">
                    <a href="{{ url('/admin/login') }}" class="text-gray-400 hover:text-white transition-colors">Panel CMS Admin</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Application Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            startClock();
            setupMobileMenu();
        });

        // Live Clock Generator
        function startClock() {
            const updateTime = () => {
                const now = new Date();
                const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
                const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' });

                const clockEl = document.getElementById('realtime-clock');
                const dateEl = document.getElementById('realtime-date');
                if (clockEl) clockEl.textContent = timeStr;
                if (dateEl) dateEl.textContent = dateStr;
            };
            updateTime();
            setInterval(updateTime, 1000);
        }

        // Form Submission via AJAX to Laravel Controller
        async function handleFormSubmit(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const btnIcon = document.getElementById('btnIcon');
            const btnText = document.getElementById('btnText');

            const nim = document.getElementById('nim').value.trim();
            const nama = document.getElementById('nama').value.trim();
            const tujuan = document.getElementById('tujuan').value.trim();
            const lab_id = document.getElementById('lab_id').value;

            if (!nim || !nama || !tujuan) {
                showToast('Mohon lengkapi NIM, Nama, dan Tujuan.', 'error');
                return;
            }

            // Disable submit button during request
            submitBtn.disabled = true;
            btnText.textContent = 'Menyimpan...';
            btnIcon.innerHTML = '<i class="ph ph-spinner animate-spin text-xl text-accent"></i>';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const response = await fetch("{{ route('absensi.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        nim: nim,
                        nama: nama,
                        tujuan: tujuan,
                        lab_id: lab_id || null
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Prepend new attendance item to list
                    prependStudentItem(result.data);

                    // Update counter
                    const countBadge = document.getElementById('total-count-badge');
                    if (countBadge) {
                        countBadge.textContent = result.total_today;
                    }

                    // Reset form
                    document.getElementById('attendanceForm').reset();

                    showToast(`Presensi berhasil! Selamat datang, ${result.data.nama}.`, 'success');
                } else {
                    const errorMsg = result.message || 'Terjadi kesalahan saat menyimpan presensi.';
                    showToast(errorMsg, 'error');
                }
            } catch (error) {
                console.error('Error submitting attendance:', error);
                showToast('Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Simpan Absensi';
                btnIcon.innerHTML = '<i class="text-accent text-xl group-hover:scale-110 transition-transform ph ph-check-circle"></i>';
            }
        }

        // Prepend Item into DOM
        function prependStudentItem(data) {
            const listContainer = document.getElementById('students-list');
            if (!listContainer) return;

            // Remove empty state if present
            const emptyState = document.getElementById('empty-state');
            if (emptyState) emptyState.remove();

            const card = document.createElement('div');
            card.className = "student-item p-4 bg-blue-50/50 border border-blue-200 rounded-xl hover:bg-white hover:border-blue-300 transition-all shadow-2xs space-y-1.5 animate-pulse";
            card.setAttribute('data-search', `${data.nama} ${data.nim} ${data.lab_nama || ''} ${data.tujuan}`.toLowerCase());

            const labBadge = data.lab_nama && data.lab_nama !== 'Umum / Semua Lab'
                ? `<span class="ml-2 inline-flex items-center bg-blue-100 text-blue-800 text-[10px] font-medium px-2 py-0.5 rounded-full">${data.lab_nama}</span>`
                : '';

            card.innerHTML = `
                <div class="flex justify-between items-center gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex justify-center items-center bg-emerald-500 text-white rounded-lg w-8 h-8 font-bold text-xs shrink-0 item-number">
                            <i class="ph ph-check"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-gray-800 text-sm truncate">${data.nama}</h4>
                            <span class="font-mono font-semibold text-primary text-xs">${data.nim}</span>
                            ${labBadge}
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 bg-emerald-100 px-2.5 py-1 border border-emerald-300 rounded-lg font-mono font-bold text-emerald-800 text-xs shrink-0">
                        <i class="text-sm ph ph-clock"></i> ${data.jam}
                    </span>
                </div>
                <div class="flex items-center gap-1.5 pt-1.5 border-gray-200/60 border-t text-gray-600 text-xs">
                    <i class="text-gray-400 ph ph-subtitles"></i>
                    <span class="font-medium text-gray-700">Tujuan:</span>
                    <span class="text-gray-600 truncate">${data.tujuan}</span>
                </div>
            `;

            listContainer.prepend(card);

            setTimeout(() => {
                card.classList.remove('bg-blue-50/50', 'border-blue-200', 'animate-pulse');
                card.classList.add('bg-gray-50', 'border-gray-100');
            }, 1500);

            // Re-index item numbers
            reindexList();
        }

        function reindexList() {
            const numbers = document.querySelectorAll('.student-item .item-number');
            numbers.forEach((el, idx) => {
                if (!el.querySelector('i')) {
                    el.textContent = idx + 1;
                }
            });
        }

        // Filter Students by Search Input
        function filterStudents() {
            const searchInput = document.getElementById('search-input');
            if (!searchInput) return;
            const query = searchInput.value.toLowerCase();
            const items = document.querySelectorAll('.student-item');
            items.forEach(item => {
                const searchData = item.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Toast Notification Helper
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast-notify');
            const toastTitle = document.getElementById('toast-title');
            const toastMsg = document.getElementById('toast-msg');
            const toastIcon = document.getElementById('toast-icon');
            const toastCard = document.getElementById('toast-card');
            if (!toast || !toastMsg) return;

            toastMsg.textContent = message;

            if (type === 'error') {
                toastTitle.textContent = 'Gagal';
                toastIcon.className = "flex justify-center items-center bg-rose-500/20 rounded-xl w-8 h-8 text-rose-400 text-xl shrink-0";
                toastIcon.innerHTML = '<i class="ph ph-x-bold"></i>';
            } else {
                toastTitle.textContent = 'Absensi Berhasil!';
                toastIcon.className = "flex justify-center items-center bg-emerald-500/20 rounded-xl w-8 h-8 text-emerald-400 text-xl shrink-0";
                toastIcon.innerHTML = '<i class="ph ph-check-bold"></i>';
            }

            toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');

            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
            }, 3500);
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

            // Header Scroll Effect
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
