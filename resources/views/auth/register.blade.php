<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Akun | Paws & Hearts Adoption</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
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
                                400: '#fb923c',
                                500: '#f97316',
                                600: '#ea580c',
                                700: '#c2410c',
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            @keyframes floatSlow {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-12px) rotate(1.5deg); }
            }
            @keyframes blobPulse {
                0%, 100% { transform: scale(1) translate(0px, 0px); }
                50% { transform: scale(1.1) translate(20px, -20px); }
            }
            .animate-float {
                animation: floatSlow 6s ease-in-out infinite;
            }
            .animate-blob {
                animation: blobPulse 8s ease-in-out infinite alternate;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.88);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.6);
            }
            .dark .glass-card {
                background: rgba(15, 23, 42, 0.88);
                border: 1px solid rgba(51, 65, 85, 0.6);
            }
        </style>
    </head>
    <body class="h-full bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 font-sans antialiased overflow-x-hidden selection:bg-brand-500 selection:text-white flex items-center justify-center p-4 sm:p-6 lg:p-8">

        <!-- Background Atmospheric Blobs -->
        <div class="fixed top-0 left-0 w-96 h-96 bg-amber-400/25 rounded-full blur-3xl -z-10 animate-blob"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl -z-10 animate-blob" style="animation-delay: 3s;"></div>

        <!-- Main Container Card -->
        <div class="w-full max-w-5xl glass-card rounded-[2.5rem] shadow-2xl shadow-orange-500/10 overflow-hidden flex flex-col lg:flex-row border border-slate-200/80 dark:border-slate-800 relative z-10 transition-all duration-300">

            <!-- ================= LEFT COLUMN: FORM REGISTER ================= -->
            <div class="w-full lg:w-7/12 p-8 sm:p-12 lg:p-14 flex flex-col justify-between">

                <div>
                    <!-- Brand & Back Button -->
                    <div class="flex items-center justify-between mb-8">
                        <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-500 flex items-center justify-center text-white shadow-md shadow-orange-500/30 group-hover:scale-105 group-hover:rotate-6 transition-all duration-300">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <circle cx="4.5" cy="9.5" r="2.5"/>
                                    <circle cx="9" cy="5.5" r="2.5"/>
                                    <circle cx="15" cy="5.5" r="2.5"/>
                                    <circle cx="19.5" cy="9.5" r="2.5"/>
                                    <path d="M17.34 14.86c-.87-1.02-1.6-1.89-2.48-2.49-1.67-1.14-3.95-.97-5.59.39-.77.64-1.45 1.48-2.28 2.45-1.57 1.83-2.19 3.53-1.69 4.67.65 1.5 2.8 1.95 5.25 1.15.54-.18 1.1-.39 1.68-.41.6.02 1.17.23 1.71.41 2.44.8 4.6.35 5.25-1.15.5-1.14-.12-2.84-1.85-5.02z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                Paws<span class="text-brand-500">&amp;Hearts</span>
                            </span>
                        </a>

                        <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-500 hover:text-brand-600 flex items-center gap-1 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <!-- Greeting -->
                    <div class="mb-8">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                            Buat Akun Baru
                        </h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                            Bergabunglah bersama kami dan temukan sahabat berbulu barumu.
                        </p>
                    </div>

                    <!-- Alert Notifikasi Error -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-900 flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-rose-100 dark:bg-rose-900/60 text-rose-600 dark:text-rose-300 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="text-xs sm:text-sm font-medium text-rose-700 dark:text-rose-300">
                                <p>{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Register Form -->
                    <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Nama Lengkap
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="John Doe"
                                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white dark:bg-slate-900 border @error('name') border-rose-400 dark:border-rose-700 @else border-slate-200 dark:border-slate-800 @enderror focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Alamat Email
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                </div>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="nama@email.com"
                                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white dark:bg-slate-900 border @error('email') border-rose-400 dark:border-rose-700 @else border-slate-200 dark:border-slate-800 @enderror focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Kata Sandi
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    required
                                    placeholder="Minimal 8 karakter"
                                    class="w-full pl-11 pr-12 py-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Konfirmasi Kata Sandi
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    required
                                    placeholder="Ulangi kata sandi"
                                    class="w-full pl-11 pr-12 py-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full mt-4 py-3.5 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:from-amber-600 hover:to-orange-600 text-white font-bold text-sm sm:text-base shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group cursor-pointer"
                        >
                            <span>Daftar Sekarang</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Footer Sign-in Link -->
                <div class="mt-6 pt-5 border-t border-slate-200/80 dark:border-slate-800 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Sudah punya akun?
                        <a href="{{ url('/login') }}" class="font-bold text-brand-600 dark:text-brand-400 hover:underline underline-offset-4 transition-colors">
                            Masuk di sini &rarr;
                        </a>
                    </p>
                </div>
            </div>

            <!-- ================= RIGHT COLUMN: VISUAL SHOWCASE ================= -->
            <div class="hidden lg:flex lg:w-5/12 relative bg-gradient-to-br from-amber-500 to-orange-600 p-12 flex-col justify-between overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1548767797-d8c844163c4c?auto=format&fit=crop&w=900&q=80"
                    alt="Happy Adopted Dog and Cat"
                    class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40 scale-105"
                >

                <div class="relative z-10 self-end bg-white/20 backdrop-blur-md border border-white/30 text-white px-4 py-2 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg">
                    <span class="animate-pulse text-base">❤️</span>
                    <span>1,400+ Sahabat Telah Teradopsi</span>
                </div>

                <div class="relative z-10 animate-float my-auto">
                    <div class="bg-white/15 backdrop-blur-xl border border-white/25 p-6 rounded-3xl text-white shadow-2xl">
                        <div class="flex items-center gap-3 mb-4">
                            <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80" alt="Adopter Avatar">
                            <div>
                                <h4 class="font-bold text-sm">Sarah &amp; Mochi</h4>
                                <p class="text-xs text-white/80">Diadopsi 2 bulan lalu</p>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-white/95 leading-relaxed italic">
                            "Mengadopsi Mochi lewat platform ini adalah keputusan terbaik. Prosesnya sangat mudah, transparan, dan sekarang rumah kami penuh tawa!"
                        </p>
                    </div>
                </div>

                <div class="relative z-10 flex items-center gap-3 text-white/90">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">
                        ✓
                    </div>
                    <p class="text-xs leading-tight">
                        Platform resmi &amp; terverifikasi dengan puluhan shelter terpercaya di seluruh Indonesia.
                    </p>
                </div>

            </div>

        </div>

    </body>
</html>
