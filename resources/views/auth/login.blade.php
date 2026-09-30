<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masuk | Paws & Hearts Adoption</title>

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

            <!-- ================= LEFT COLUMN: FORM LOGIN ================= -->
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
                            Selamat Datang Kembali! 
                        </h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                            Masuk untuk melanjutkan proses adopsi sahabat barumu.
                        </p>
                    </div>

                    <!-- Alert Notifikasi Error (Bebas error Blade) -->
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

                    <!-- Login Form -->
                    <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                        @csrf

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
                                    class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white dark:bg-slate-900 border @error('email') border-rose-400 dark:border-rose-700 @else border-slate-200 dark:border-slate-800 @enderror focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    Kata Sandi
                                </label>
                                <a href="#" class="text-xs font-semibold text-brand-600 hover:text-brand-700 transition-colors">
                                    Lupa sandi?
                                </a>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    required
                                    placeholder="••••••••"
                                    class="w-full pl-11 pr-12 py-3.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm font-medium outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600"
                                >
                                <!-- Toggle Password Visibility -->
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="w-4 h-4 rounded text-brand-500 focus:ring-brand-400 border-slate-300 dark:border-slate-700 dark:bg-slate-900 cursor-pointer"
                            >
                            <label for="remember" class="ml-2.5 text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 select-none cursor-pointer">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:from-amber-600 hover:to-orange-600 text-white font-bold text-sm sm:text-base shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group cursor-pointer"
                        >
                            <span>Masuk ke Akun</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Footer Sign-up Link -->
                <div class="mt-8 pt-6 border-t border-slate-200/80 dark:border-slate-800 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Belum punya akun?
                        <a href="{{ url('/register') }}" class="font-bold text-brand-600 dark:text-brand-400 hover:underline underline-offset-4 transition-colors">
                            Daftar Sekarang &rarr;
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

        <!-- Script Show/Hide Password -->
        <script>
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePasswordBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                if (isPassword) {
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>`;
                } else {
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                }
            });
        </script>
    </body>
</html>
