@extends('layouts.user')

@section('title', 'Riwayat Pengajuan Adopsi')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12">
            <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600">Perjalanan Adopsi Anda</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">Riwayat Pengajuan</h1>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="p-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Kucing</th>
                            <th class="p-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                            <th class="p-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status Adopsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($adoptions as $adoption)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-200 shrink-0">
                                            <img src="{{ Storage::url($adoption->cat->photo_path) }}" alt="Foto" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-base">{{ $adoption->cat->name }}</p>
                                            <p class="text-xs font-medium text-slate-500">{{ $adoption->cat->breed }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <p class="text-sm font-semibold text-slate-700">{{ $adoption->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-400">{{ $adoption->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="p-6">
                                    @php
                                        $statusColors = [
                                            \App\Enums\AdoptionStatus::PENDING->value => 'bg-amber-100 text-amber-700 border-amber-200',
                                            \App\Enums\AdoptionStatus::APPROVED->value => 'bg-blue-100 text-blue-700 border-blue-200',
                                            \App\Enums\AdoptionStatus::REJECTED->value => 'bg-rose-100 text-rose-700 border-rose-200',
                                            \App\Enums\AdoptionStatus::COMPLETED->value => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        ];
                                        $colorClass = $statusColors[$adoption->status->value] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                    @endphp
                                    
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full {{ $colorClass }} border text-xs font-bold uppercase tracking-wider mb-2">
                                        {{ $adoption->status->value }}
                                    </span>

                                    @if($adoption->status === \App\Enums\AdoptionStatus::APPROVED)
                                        <div class="mt-2 bg-blue-50 border border-blue-100 rounded-xl p-3 inline-block">
                                            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-1">Order Code (Bawa saat ambil):</p>
                                            <p class="font-mono text-lg font-extrabold text-blue-800 tracking-widest">{{ $adoption->order_code }}</p>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <a href="{{ route('user.adoptions.proof', $adoption->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-colors shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Download Surat Adopsi (PDF)
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-12 text-center">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">📋</div>
                                    <p class="text-base font-bold text-slate-800">Anda belum pernah mengajukan adopsi.</p>
                                    <a href="{{ url('/catalog') }}" class="inline-block mt-4 text-sm font-bold text-brand-600 hover:text-brand-700">Lihat Katalog Hewan &rarr;</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
