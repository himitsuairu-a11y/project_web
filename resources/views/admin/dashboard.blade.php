@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Overview Dashboard')

@section('content')
    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Total Kucing -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-brand-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total Kucing</p>
                    <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalCats }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </div>
            <div class="relative z-10 mt-4 text-xs font-semibold text-slate-400">Keseluruhan data yang tercatat di sistem</div>
        </div>

        <!-- Kucing Tersedia -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Tersedia</p>
                    <h3 class="text-4xl font-extrabold text-slate-800">{{ $availableCats }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="relative z-10 mt-4 text-xs font-semibold text-emerald-600">Kucing siap untuk diadopsi hari ini</div>
        </div>

        <!-- Menunggu Persetujuan -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Menunggu Persetujuan</p>
                    <h3 class="text-4xl font-extrabold text-slate-800">{{ $pendingAdoptions }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="relative z-10 mt-4 text-xs font-semibold text-rose-600">Pengajuan yang butuh review segera</div>
        </div>
    </div>

    <!-- Actions & Quick Links -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm mb-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Laporan Eksekutif</h3>
            <p class="text-sm text-slate-500">Unduh rangkuman keseluruhan data adopsi dan inventaris hewan.</p>
        </div>
        <a href="{{ route('admin.report.pdf') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-900 text-white font-bold hover:bg-brand-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Unduh Laporan PDF
        </a>
    </div>
@endsection
