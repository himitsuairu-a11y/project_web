<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Paws & Hearts</title>

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
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover, .nav-item.active {
            background: linear-gradient(to right, #f97316, #ea580c);
            color: white !important;
            transform: translateX(4px);
        }
        .nav-item.active {
            box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3), 0 2px 4px -1px rgba(249, 115, 22, 0.2);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" class="bg-slate-50 font-sans antialiased text-slate-800 flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white relative">

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-10 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="w-64 glass-sidebar h-full flex flex-col shadow-lg z-20 shrink-0 absolute lg:relative transform transition-transform duration-300 lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex items-center justify-center border-b border-slate-200">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-500 flex items-center justify-center text-white shadow-md shadow-orange-500/30 group-hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <circle cx="4.5" cy="9.5" r="2.5"/>
                        <circle cx="9" cy="5.5" r="2.5"/>
                        <circle cx="15" cy="5.5" r="2.5"/>
                        <circle cx="19.5" cy="9.5" r="2.5"/>
                        <path d="M17.34 14.86c-.87-1.02-1.6-1.89-2.48-2.49-1.67-1.14-3.95-.97-5.59.39-.77.64-1.45 1.48-2.28 2.45-1.57 1.83-2.19 3.53-1.69 4.67.65 1.5 2.8 1.95 5.25 1.15.54-.18 1.1-.39 1.68-.41.6.02 1.17.23 1.71.41 2.44.8 4.6.35 5.25-1.15.5-1.14-.12-2.84-1.85-5.02z"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-extrabold tracking-tight text-slate-900">Paws<span class="text-brand-500">&amp;Hearts</span></span>
                    <span class="text-[9px] font-semibold tracking-wider text-slate-400 uppercase -mt-1">Admin Panel</span>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="px-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('admin.cats.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.cats.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Katalog Kucing
            </a>
            
            <a href="{{ route('admin.adoptions.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.adoptions.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Pengajuan Adopsi
            </a>
            
            <a href="{{ route('admin.verify.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.verify.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Verifikasi Pengambilan
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Manajemen Pengguna
            </a>

            <a href="{{ route('admin.settings.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pengaturan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-200 space-y-2">
            <a href="{{ url('/') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-slate-50 relative">
        <!-- Top Header -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 z-10 shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h2 class="text-xl font-bold text-slate-800 hidden sm:block">@yield('header', 'Dashboard')</h2>
                <h2 class="text-lg font-bold text-slate-800 sm:hidden">Paws&Hearts</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex flex-col items-end">
                    <span class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-slate-500">Administrator</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold border-2 border-brand-200 shadow-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-auto p-8">
            <div class="max-w-6xl mx-auto">
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

                @yield('content')
            </div>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
