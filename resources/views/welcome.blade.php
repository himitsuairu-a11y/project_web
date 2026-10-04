<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Paws & Hearts') }} - Adopsi Hewan Kesayangan</title>

        <!-- Fonts Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Tailwind CSS CDN (Memastikan UI & utility selalu tampil sempurna) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                50: '#fff7ed',
                                100: '#ffedd5',
                                500: '#f97316',
                                600: '#ea580c',
                                700: '#c2410c',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Custom Keyframe Animations & Glass Effects -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-12px) rotate(1deg); }
            }
            @keyframes pulseGlow {
                0%, 100% { opacity: 0.3; transform: scale(1); }
                50% { opacity: 0.6; transform: scale(1.08); }
            }
            .animate-float {
                animation: float 5s ease-in-out infinite;
            }
            .animate-glow {
                animation: pulseGlow 6s ease-in-out infinite;
            }
            .nav-glass {
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            }
            .dark .nav-glass {
                background: rgba(15, 23, 42, 0.92);
                border-bottom: 1px solid rgba(51, 65, 85, 0.8);
            }
        </style>
    </head>
    <body x-data class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-sans antialiased overflow-x-hidden selection:bg-brand-500 selection:text-white">

        <!-- ================= NAVBAR ================= -->
        <header class="fixed top-0 left-0 right-0 z-50 nav-glass transition-all duration-300 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">

                    <!-- Logo Brand -->
                    <a href="#beranda" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-orange-500/30 group-hover:scale-105 group-hover:rotate-6 transition-all duration-300">
                            <!-- Icon Paw -->
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <circle cx="4.5" cy="9.5" r="2.5"/>
                                <circle cx="9" cy="5.5" r="2.5"/>
                                <circle cx="15" cy="5.5" r="2.5"/>
                                <circle cx="19.5" cy="9.5" r="2.5"/>
                                <path d="M17.34 14.86c-.87-1.02-1.6-1.89-2.48-2.49-1.67-1.14-3.95-.97-5.59.39-.77.64-1.45 1.48-2.28 2.45-1.57 1.83-2.19 3.53-1.69 4.67.65 1.5 2.8 1.95 5.25 1.15.54-.18 1.1-.39 1.68-.41.6.02 1.17.23 1.71.41 2.44.8 4.6.35 5.25-1.15.5-1.14-.12-2.84-1.85-5.02z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white flex items-center">
                                Paws<span class="text-brand-500">&amp;Hearts</span>
                            </span>
                            <span class="text-[10px] font-semibold tracking-wider text-slate-400 uppercase -mt-1">Adoption Platform</span>
                        </div>
                    </a>

                    <!-- Nav Items (Desktop Menu) -->
                    <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                        <a href="#beranda" class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-500 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                            Beranda
                        </a>
                        <a href="#katalog" class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-500 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                            Katalog Hewan
                        </a>
                        <a href="#cara-adopsi" class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-500 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                            Cara Adopsi
                        </a>
                        <a href="#about" class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-500 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                            Tentang Kami
                        </a>
                        <a href="#kontak" class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-500 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                            Kontak
                        </a>
                    </nav>

                    <!-- Auth Actions (Desktop) -->
                    <div class="hidden md:flex items-center gap-3">
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADMIN->value) || auth()->user()->role === \App\Enums\UserRole::ADMIN->value)
                                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-slate-900 dark:bg-brand-500 dark:hover:bg-brand-600 rounded-full hover:shadow-lg transition-all duration-300">
                                        Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('user.dashboard') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-slate-900 dark:bg-brand-500 dark:hover:bg-brand-600 rounded-full hover:shadow-lg transition-all duration-300">
                                        Dashboard User
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-red-600 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-brand-600 transition-colors">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-full shadow-md shadow-orange-500/25 hover:shadow-orange-500/40 hover:-translate-y-0.5 transition-all duration-300">
                                        Daftar Akun
                                    </a>
                                @endif
                            @endauth
                        @else
                            {{-- Fallback jika auth Laravel belum di-generate --}}
                            <a href="#login" class="px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-brand-600 transition-colors">
                                Masuk
                            </a>
                            <a href="#register" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-full shadow-md shadow-orange-500/25 hover:shadow-orange-500/40 hover:-translate-y-0.5 transition-all duration-300">
                                Daftar Akun
                            </a>
                        @endif
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <div class="flex md:hidden items-center">
                        <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:text-brand-500 transition-colors focus:outline-none" aria-label="Toggle Menu">
                            <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl px-6 py-6 transition-all duration-300">
                <div class="flex flex-col gap-3">
                    <a href="#beranda" class="mobile-link text-base font-semibold text-slate-800 dark:text-slate-200 hover:text-brand-500 py-2">Beranda</a>
                    <a href="#katalog" class="mobile-link text-base font-semibold text-slate-800 dark:text-slate-200 hover:text-brand-500 py-2">Katalog Hewan</a>
                    <a href="#cara-adopsi" class="mobile-link text-base font-semibold text-slate-800 dark:text-slate-200 hover:text-brand-500 py-2">Cara Adopsi</a>
                    <a href="#about" class="mobile-link text-base font-semibold text-slate-800 dark:text-slate-200 hover:text-brand-500 py-2">Tentang Kami</a>
                    <a href="#kontak" class="mobile-link text-base font-semibold text-slate-800 dark:text-slate-200 hover:text-brand-500 py-2">Kontak</a>

                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col gap-3">
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADMIN->value) || auth()->user()->role === \App\Enums\UserRole::ADMIN->value)
                                    <a href="{{ route('admin.dashboard') }}" class="w-full text-center py-3 rounded-xl bg-brand-500 text-white font-bold">Dashboard Admin</a>
                                @else
                                    <a href="{{ route('user.dashboard') }}" class="w-full text-center py-3 rounded-xl bg-brand-500 text-white font-bold">Dashboard User</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-center py-2.5 rounded-xl border border-red-300 text-red-600 font-bold">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 font-bold">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl bg-brand-500 text-white font-bold">Daftar Akun</a>
                                @endif
                            @endauth
                        @else
                            <a href="#login" class="w-full text-center py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 font-bold">Masuk</a>
                            <a href="#register" class="w-full text-center py-2.5 rounded-xl bg-brand-500 text-white font-bold">Daftar Akun</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- ================= HERO SECTION ================= -->
        <section id="beranda" class="relative pt-36 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- Background Glow Elements -->
            <div class="absolute top-20 left-1/4 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl -z-10 animate-glow"></div>
            <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl -z-10 animate-glow" style="animation-delay: 3s;"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                    <!-- Left Hero Text -->
                    <div class="lg:col-span-7 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 text-xs sm:text-sm font-bold tracking-wide mb-6">
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                            </span>
                            🐾 Lebih dari 1.400+ Hewan Berhasil Menemukan Rumah
                        </div>

                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.1] mb-6">
                            Beri Mereka Cinta, <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500">
                                Temukan Sahabat Sejatimu
                            </span>
                        </h1>

                        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">
                            Setiap kibasan ekor dan dengkuran adalah cerita baru yang menunggumu. Jangan beli, adopsi dan berikan kesempatan kedua bagi mereka untuk hidup bahagia.
                        </p>

                        <!-- Call to Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                            <a href="{{ url('/catalog') }}" class="w-full sm:w-auto px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold text-center shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                <span>Adopsi Sekarang</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="#cara-adopsi" class="w-full sm:w-auto px-8 py-4 rounded-full bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 hover:border-amber-500 dark:hover:border-amber-500 text-slate-800 dark:text-slate-100 font-bold text-center hover:-translate-y-1 transition-all duration-300 shadow-sm">
                                Pelajari Prosedur
                            </a>
                        </div>

                        <!-- Stats Strip -->
                        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 grid grid-cols-3 gap-6 max-w-lg mx-auto lg:mx-0">
                            <div>
                                <h4 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">100%</h4>
                                <p class="text-xs sm:text-sm text-slate-500 font-medium">Divaksin &amp; Sehat</p>
                            </div>
                            <div>
                                <h4 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">50+</h4>
                                <p class="text-xs sm:text-sm text-slate-500 font-medium">Shelter Mitra</p>
                            </div>
                            <div>
                                <h4 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">GRATIS</h4>
                                <p class="text-xs sm:text-sm text-slate-500 font-medium">Biaya Adopsi Resmi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Hero Floating Graphic -->
                    <div class="lg:col-span-5 relative">
                        <div class="relative max-w-md mx-auto">
                            <!-- Background Frame Accent -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-amber-400 to-rose-400 rounded-[3rem] rotate-3 scale-105 opacity-80 filter blur-sm"></div>

                            <!-- Main Hero Image with Floating Animation -->
                            <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white dark:border-slate-800 aspect-[4/5] animate-float">
                                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=800&q=80"
                                     alt="Kucing Adopsi Lucu"
                                     class="w-full h-full object-cover">
                            </div>

                            <!-- Floating Badge 1 (Medical Check) -->
                            <div class="absolute -left-6 top-1/4 bg-white/95 dark:bg-slate-800/95 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100 dark:border-slate-700 animate-bounce" style="animation-duration: 4s;">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">
                                    ✓
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 dark:text-white">Medical Checked</p>
                                    <p class="text-[11px] text-slate-500">Bebas Parasit &amp; Sehat</p>
                                </div>
                            </div>

                            <!-- Floating Badge 2 (Friendly & Ready) -->
                            <div class="absolute -right-4 bottom-10 bg-white/95 dark:bg-slate-800/95 backdrop-blur-md p-4 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100 dark:border-slate-700 animate-bounce" style="animation-duration: 5s; animation-delay: 1.5s;">
                                <span class="text-3xl">🐱</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 dark:text-white">Siap Pulang Hari Ini</p>
                                    <p class="text-[11px] text-emerald-600 font-semibold">Tersedia 24 Sahabat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ================= KATALOG HEWAN ================= -->
        <section id="katalog" class="py-24 bg-white dark:bg-slate-950 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600 dark:text-brand-500">Siap Diadopsi</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-1">
                            Kenalan dengan Mereka Yuk!
                        </h2>
                    </div>
                    <p class="text-slate-500 max-w-md mt-4 md:mt-0 text-sm sm:text-base">
                        Setiap hewan telah melalui pemeriksaan medis ketat, vaksinasi rutin, dan sterilisasi oleh dokter hewan berpengalaman.
                    </p>
                </div>

                <!-- Pet Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse($featuredCats as $cat)
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-[2rem] overflow-hidden border border-slate-200 dark:border-slate-800 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ Storage::url($cat->photo_path) }}"
                                     alt="Foto Kucing"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3.5 py-1 rounded-full text-xs font-bold text-slate-900 dark:text-white">
                                    😺 Kucing
                                </span>
                                <span class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                                    {{ $cat->age_in_months }} Bulan
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $cat->name }}</h3>
                                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 dark:bg-emerald-950/60 px-2.5 py-1 rounded-lg">{{ $cat->breed }}</span>
                                </div>
                                <p class="text-sm text-slate-500 mb-6 leading-relaxed line-clamp-2">
                                    {{ $cat->condition }}
                                </p>
                                <button type="button" @click="$dispatch('open-detail', {{ json_encode([
                                    'name' => $cat->name,
                                    'breed' => $cat->breed,
                                    'age' => $cat->age_in_months,
                                    'condition' => $cat->condition,
                                    'photo' => Storage::url($cat->photo_path),
                                    'photos' => $cat->photos ? array_map(fn($p) => Storage::url($p), $cat->photos) : []
                                ]) }})" class="block text-center w-full py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-white font-bold group-hover:bg-gradient-to-r group-hover:from-amber-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300">
                                    Lihat {{ $cat->name }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-500">
                            Belum ada hewan yang tersedia untuk diadopsi saat ini.
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

        <!-- ================= CARA ADOPSI ================= -->
        <section id="cara-adopsi" class="py-24 bg-slate-100/70 dark:bg-slate-900/60 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600 dark:text-brand-500">Langkah Mudah</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">
                        Bagaimana Cara Mengadopsi?
                    </h2>
                    <p class="text-slate-500 mt-4 text-sm sm:text-base">
                        Proses adopsi kami rancang agar aman, transparan, dan memastikan kesejahteraan terbaik bagi calon hewan peliharaanmu.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">

                    <!-- Step 1 -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center relative group hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 font-extrabold text-xl flex items-center justify-center mb-6 shadow-inner">
                            01
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Pilih Sahabat</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Cari hewan yang karakternya paling cocok dengan gaya hidup dan tempat tinggalmu.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center relative group hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-orange-100 dark:bg-orange-950/60 text-orange-600 dark:text-orange-400 font-extrabold text-xl flex items-center justify-center mb-6 shadow-inner">
                            02
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Isi Formulir</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Lengkapi kuisioner singkat untuk membantu tim shelter memahami kesiapan komitmenmu.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center relative group hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 font-extrabold text-xl flex items-center justify-center mb-6 shadow-inner">
                            03
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Meet &amp; Greet</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Datang ke shelter untuk berinteraksi langsung dan memastikan adanya ikatan kecocokan.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col items-center text-center relative group hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 font-extrabold text-xl flex items-center justify-center mb-6 shadow-inner">
                            04
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Bawa Pulang</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Tandatangani surat adopsi resmi dan mulailah petualangan bahagiamu bersama mereka!
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= ABOUT US ================= -->
        <section id="about" class="py-24 bg-white dark:bg-slate-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    <div class="lg:col-span-6 relative">
                        <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-video lg:aspect-square">
                            <img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?auto=format&fit=crop&w=800&q=80"
                                 alt="Shelter Care"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-amber-500 text-white p-6 rounded-3xl shadow-xl hidden sm:block">
                            <p class="text-4xl font-extrabold">5+ Tahun</p>
                            <p class="text-sm font-semibold opacity-90">Mengabdi untuk Kesejahteraan Hewan</p>
                        </div>
                    </div>

                    <div class="lg:col-span-6">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600 dark:text-brand-500">Misi Kami</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2 mb-6">
                            Menghubungkan Hati Manusia dengan Hewan yang Membutuhkan Kasih Sayang
                        </h2>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            <strong>Paws &amp; Hearts</strong> didirikan dengan satu komitmen sederhana: menghentikan penelantaran hewan dan memberikan ruang aman bagi anjing dan kucing jalanan untuk menemukan keluarga sejati mereka.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold shrink-0 mt-1">✓</div>
                                <p class="text-sm text-slate-600 dark:text-slate-300"><strong class="text-slate-900 dark:text-white">Edukasi Kepemilikan Bertanggung Jawab:</strong> Pendampingan seputar vaksin, nutrisi, dan perilaku hewan bagi setiap pengadopsi baru.</p>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold shrink-0 mt-1">✓</div>
                                <p class="text-sm text-slate-600 dark:text-slate-300"><strong class="text-slate-900 dark:text-white">Jaringan Shelter Terpercaya:</strong> Berkolaborasi dengan puluhan klinik dan dokter hewan independen.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ================= KONTAK & FOOTER ================= -->
        <footer id="kontak" class="bg-slate-900 text-slate-300 pt-20 pb-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-16 border-b border-slate-800">

                    <div class="md:col-span-2">
                        <span class="text-2xl font-extrabold text-white tracking-tight flex items-center gap-2 mb-4">
                            Paws<span class="text-amber-500">&amp;Hearts</span>
                        </span>
                        <p class="text-sm text-slate-400 max-w-sm mb-6 leading-relaxed">
                            Membantu hewan terlantar menemukan rumah yang hangat dan penuh cinta. Setiap nyawa berharga untuk diperjuangkan.
                        </p>
                        <p class="text-xs text-slate-500">
                            Laravel Framework v{{ app()->version() }} • Didesain dengan standar UI/UX modern.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Navigasi Cepat</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="#beranda" class="hover:text-amber-400 transition-colors">Beranda</a></li>
                            <li><a href="#katalog" class="hover:text-amber-400 transition-colors">Katalog Hewan</a></li>
                            <li><a href="#cara-adopsi" class="hover:text-amber-400 transition-colors">Cara Adopsi</a></li>
                            <li><a href="#about" class="hover:text-amber-400 transition-colors">Tentang Kami</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Pusat Bantuan</h4>
                        <ul class="space-y-2.5 text-sm text-slate-400">
                            <li>Email: support@pawsandhearts.org</li>
                            <li>WhatsApp: +62 812-3456-7890</li>
                            <li>Buka: Setiap Hari (08.00 - 17.00 WITA)</li>
                        </ul>
                    </div>

                </div>

                <div class="pt-8 text-center text-xs text-slate-500">
                    &copy; {{ date('Y') }} Paws &amp; Hearts Indonesia. All rights reserved.
                </div>
            </div>
        </footer>

        <!-- ================= SCRIPT MOBILE MENU INTERACTIVE ================= -->
        <script>
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Otomatis tutup menu drawer ketika salah satu link diklik
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        </script>
    <!-- Detail Modal -->
    <div x-data="{ 
        open: false, 
        cat: { name: '', breed: '', age: '', condition: '', photo: '', photos: [] },
        activePhoto: ''
    }" 
    @open-detail.window="
        cat = $event.detail; 
        activePhoto = cat.photo;
        open = true;
    "
    x-show="open" 
    class="fixed inset-0 z-[110] flex items-center justify-center" style="display: none;">
        <!-- Backdrop -->
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>
        
        <!-- Modal Content -->
        <div x-show="open" x-transition class="bg-white dark:bg-slate-900 rounded-3xl overflow-hidden max-w-lg w-full mx-4 relative z-10 shadow-2xl flex flex-col">
            <button @click="open = false" class="absolute top-4 right-4 p-2 text-slate-600 dark:text-slate-300 bg-white/50 dark:bg-slate-900/50 backdrop-blur rounded-full hover:bg-white dark:hover:bg-slate-800 transition-colors z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <div class="h-64 w-full bg-slate-100 dark:bg-slate-800 relative group">
                <img :src="activePhoto" class="w-full h-full object-cover">
            </div>
            
            <!-- Thumbnail gallery -->
            <div class="px-8 pt-6 pb-2" x-show="cat.photos && cat.photos.length > 0">
                <div class="flex gap-2 overflow-x-auto pb-2 custom-scrollbar">
                    <template x-for="p in cat.photos" :key="p">
                        <button type="button" @click="activePhoto = p" class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border-2" :class="activePhoto === p ? 'border-brand-500' : 'border-transparent opacity-60 hover:opacity-100'">
                            <img :src="p" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            <div class="p-8 pt-4">
                <h3 x-text="cat.name" class="text-3xl font-extrabold text-slate-900 dark:text-white mb-1"></h3>
                <div class="flex gap-2 mb-6">
                    <span x-text="cat.breed" class="text-xs font-bold bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg"></span>
                    <span x-text="cat.age + ' Bulan'" class="text-xs font-bold bg-amber-100 text-amber-700 px-3 py-1.5 rounded-lg"></span>
                </div>
                
                <h4 class="text-sm font-bold text-slate-700 dark:text-slate-400 mb-2 uppercase tracking-wider">Kondisi & Kepribadian</h4>
                <p x-text="cat.condition" class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8"></p>
                
                <a href="{{ url('/catalog') }}" class="block text-center w-full py-3.5 rounded-xl bg-brand-500 text-white font-bold hover:bg-brand-600 transition-all">
                    Lihat Semua di Katalog
                </a>
            </div>
        </div>
    </div>
    </body>
</html>
