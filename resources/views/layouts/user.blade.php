<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Paws & Hearts')</title>

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
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
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .nav-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body x-data class="bg-slate-50 font-sans antialiased text-slate-800 selection:bg-brand-500 selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 right-0 z-50 nav-glass transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-orange-500/30 group-hover:scale-105 group-hover:rotate-6 transition-all duration-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <circle cx="4.5" cy="9.5" r="2.5"/>
                            <circle cx="9" cy="5.5" r="2.5"/>
                            <circle cx="15" cy="5.5" r="2.5"/>
                            <circle cx="19.5" cy="9.5" r="2.5"/>
                            <path d="M17.34 14.86c-.87-1.02-1.6-1.89-2.48-2.49-1.67-1.14-3.95-.97-5.59.39-.77.64-1.45 1.48-2.28 2.45-1.57 1.83-2.19 3.53-1.69 4.67.65 1.5 2.8 1.95 5.25 1.15.54-.18 1.1-.39 1.68-.41.6.02 1.17.23 1.71.41 2.44.8 4.6.35 5.25-1.15.5-1.14-.12-2.84-1.85-5.02z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center">Paws<span class="text-brand-500">&amp;Hearts</span></span>
                    </div>
                </a>

                <!-- Nav Items (Desktop) -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="{{ url('/') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 transition-colors rounded-full hover:bg-slate-100">
                        Beranda
                    </a>
                    <a href="{{ url('/catalog') }}" class="px-4 py-2 text-sm font-semibold {{ request()->is('catalog') ? 'text-brand-600 bg-brand-50' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100' }} transition-colors rounded-full">
                        Katalog Kucing
                    </a>
                    @auth
                        @if(auth()->user()->role === \App\Enums\UserRole::ADOPTER || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADOPTER->value) || auth()->user()->role === \App\Enums\UserRole::ADOPTER->value)
                            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 text-sm font-semibold {{ request()->is('dashboard') ? 'text-brand-600 bg-brand-50' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100' }} transition-colors rounded-full">
                                Dashboard
                            </a>
                            <a href="{{ route('user.profile.edit') }}" class="px-4 py-2 text-sm font-semibold {{ request()->is('profile*') ? 'text-brand-600 bg-brand-50' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100' }} transition-colors rounded-full">
                                Profil Saya
                            </a>
                            <a href="{{ route('user.adoptions.index') }}" class="px-4 py-2 text-sm font-semibold {{ request()->is('adoptions*') ? 'text-brand-600 bg-brand-50' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100' }} transition-colors rounded-full">
                                Riwayat Adopsi
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- Auth Actions -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADMIN->value) || auth()->user()->role === \App\Enums\UserRole::ADMIN->value)
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-bold text-brand-600 bg-brand-50 rounded-full">Dashboard Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-bold text-slate-700 hover:text-red-600 transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-slate-700 hover:text-brand-600 transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-full shadow-md shadow-orange-500/25 transition-all duration-300">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                </div>
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-xl bg-slate-100 text-slate-700 hover:text-brand-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-slate-200 bg-white/95 backdrop-blur-xl px-4 py-6">
                <div class="flex flex-col gap-3">
                    <a href="{{ url('/') }}" class="font-semibold text-slate-800 py-2">Beranda</a>
                    <a href="{{ url('/catalog') }}" class="font-semibold {{ request()->is('catalog') ? 'text-brand-500' : 'text-slate-800' }} py-2">Katalog Kucing</a>
                    
                    @auth
                        @if(auth()->user()->role === \App\Enums\UserRole::ADOPTER || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADOPTER->value) || auth()->user()->role === \App\Enums\UserRole::ADOPTER->value)
                            <a href="{{ route('user.dashboard') }}" class="font-semibold {{ request()->is('dashboard') ? 'text-brand-500' : 'text-slate-800' }} py-2">Dashboard</a>
                            <a href="{{ route('user.profile.edit') }}" class="font-semibold {{ request()->is('profile*') ? 'text-brand-500' : 'text-slate-800' }} py-2">Profil Saya</a>
                            <a href="{{ route('user.adoptions.index') }}" class="font-semibold {{ request()->is('adoptions*') ? 'text-brand-500' : 'text-slate-800' }} py-2">Riwayat Adopsi</a>
                        @endif
                    @endauth

                    <div class="pt-4 border-t border-slate-200 flex flex-col gap-3">
                        @auth
                            @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (isset(auth()->user()->role->value) && auth()->user()->role->value === \App\Enums\UserRole::ADMIN->value) || auth()->user()->role === \App\Enums\UserRole::ADMIN->value)
                                <a href="{{ route('admin.dashboard') }}" class="w-full text-center py-2.5 rounded-xl bg-brand-500 text-white font-bold">Dashboard Admin</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-center py-2.5 rounded-xl border border-red-300 text-red-600 font-bold">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl border border-slate-300 font-bold">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl bg-brand-500 text-white font-bold">Daftar Akun</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

    <!-- Main Content -->
    <main class="flex-grow pt-28 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition.duration.500ms class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl shadow-sm relative">
                    <button @click="show = false" class="absolute top-3 right-3 text-rose-500 hover:text-rose-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-bold">Ada kesalahan:</span>
                    </div>
                    <ul class="list-disc pl-9 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-8 border-t border-slate-800 text-center">
        <p class="text-xs text-slate-500">&copy; {{ date('Y') }} Paws &amp; Hearts Indonesia. All rights reserved.</p>
    </footer>

    <!-- Alpine.js for Modals (Optional) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
