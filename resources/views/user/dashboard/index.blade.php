@extends('layouts.user')

@section('title', 'Dashboard Adopter')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-8 sm:p-10 text-white shadow-xl shadow-orange-500/20 mb-10 relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-2">Halo, {{ $user->name }}! 👋</h1>
            <p class="text-white/90 text-sm sm:text-base max-w-xl leading-relaxed">
                Selamat datang di Paws & Hearts. Terima kasih telah memilih untuk mengadopsi. Setiap hewan berhak mendapatkan kesempatan kedua, dan Anda adalah bagian dari perubahan tersebut.
            </p>
            <div class="mt-8 flex gap-4">
                <a href="{{ url('/catalog') }}" class="px-6 py-3 bg-white text-orange-600 font-bold rounded-xl shadow-md hover:bg-orange-50 transition-colors">
                    Adopsi Kucing Baru
                </a>
            </div>
        </div>
        
        <!-- Decoration -->
        <svg class="absolute top-0 right-0 -mr-16 -mt-16 w-96 h-96 opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center text-2xl">📝</div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Pengajuan</p>
                <p class="text-3xl font-extrabold text-slate-800">{{ $totalAdoptions }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 rounded-full bg-emerald-100 flex items-center justify-center text-2xl">🎉</div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Disetujui</p>
                <p class="text-3xl font-extrabold text-emerald-600">{{ $approvedAdoptions }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center text-2xl">⏳</div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Menunggu</p>
                <p class="text-3xl font-extrabold text-amber-600">{{ $pendingAdoptions }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Adoptions -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-xl font-extrabold text-slate-900">Aktivitas Adopsi Terbaru</h3>
            <a href="{{ route('user.adoptions.index') }}" class="text-sm font-bold text-brand-500 hover:text-brand-600">Lihat Semua &rarr;</a>
        </div>
        <div class="p-0">
            @if($adoptions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="p-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Kucing</th>
                                <th class="p-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="p-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($adoptions->take(5) as $adoption)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="p-4 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                                            <img src="{{ Storage::url($adoption->cat->photo_path) }}" alt="Foto" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">{{ $adoption->cat->name }}</p>
                                            <p class="text-xs text-slate-500">{{ $adoption->cat->breed }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 px-6">
                                    @php
                                        $statusColors = [
                                            \App\Enums\AdoptionStatus::PENDING->value => 'bg-amber-100 text-amber-700',
                                            \App\Enums\AdoptionStatus::APPROVED->value => 'bg-blue-100 text-blue-700',
                                            \App\Enums\AdoptionStatus::REJECTED->value => 'bg-rose-100 text-rose-700',
                                            \App\Enums\AdoptionStatus::COMPLETED->value => 'bg-emerald-100 text-emerald-700',
                                        ];
                                        
                                        $colorClass = $statusColors[$adoption->status->value] ?? 'bg-slate-100 text-slate-700';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full {{ $colorClass }} text-xs font-bold uppercase tracking-wider">
                                        {{ $adoption->status->value }}
                                    </span>
                                </td>
                                <td class="p-4 px-6 text-sm text-slate-600">
                                    {{ $adoption->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="py-16 text-center px-4">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">📭</div>
                    <p class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengajuan</p>
                    <p class="text-slate-500 mb-6 max-w-md mx-auto">Anda belum mengajukan adopsi apapun. Mari temukan sahabat baru Anda hari ini.</p>
                    <a href="{{ url('/catalog') }}" class="inline-block px-6 py-3 bg-slate-900 hover:bg-brand-600 text-white font-bold rounded-xl transition-colors">
                        Jelajahi Katalog
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
