@extends('layouts.admin')

@section('title', 'Katalog Kucing')
@section('header', 'Manajemen Katalog Kucing')

@section('content')
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h3 class="text-xl font-extrabold text-slate-800">Daftar Hewan</h3>
            <a href="{{ route('admin.cats.create') }}" class="px-5 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold flex items-center gap-2 transition-all shadow-md shadow-brand-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kucing Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Foto &amp; Nama</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ras &amp; Umur</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($cats as $cat)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="p-4 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                                    <img src="{{ Storage::url($cat->photo_path) }}" alt="Foto" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">{{ $cat->name }}</p>
                                    <p class="text-xs text-slate-500 truncate max-w-[150px]">{{ $cat->condition }}</p>
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="font-semibold text-slate-700 text-sm">{{ $cat->breed }}</p>
                                <p class="text-xs text-slate-500">{{ $cat->age_in_months }} Bulan</p>
                            </td>
                            <td class="p-4">
                                @if($cat->status === \App\Enums\CatStatus::AVAILABLE)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Diadopsi
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" @click="$dispatch('open-detail', {{ json_encode([
                                        'name' => $cat->name,
                                        'breed' => $cat->breed,
                                        'age' => $cat->age_in_months,
                                        'condition' => $cat->condition,
                                        'photo' => Storage::url($cat->photo_path),
                                        'photos' => $cat->photos ? array_map(fn($p) => Storage::url($p), $cat->photos) : []
                                    ]) }})" class="p-2 rounded-lg text-slate-400 hover:text-indigo-500 hover:bg-indigo-50 transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    <a href="{{ route('admin.cats.edit', $cat->id) }}" class="p-2 rounded-lg text-slate-400 hover:text-brand-500 hover:bg-brand-50 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.cats.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data kucing ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-24 h-24 mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">Belum ada data kucing</h3>
                                    <p class="text-slate-500 text-sm max-w-sm mb-4">Katalog Anda masih kosong. Mulai tambahkan profil kucing yang lucu untuk segera diadopsi.</p>
                                    <a href="{{ route('admin.cats.create') }}" class="px-5 py-2 rounded-xl bg-brand-50 text-brand-600 font-bold text-sm hover:bg-brand-100 transition-colors">
                                        + Tambah Kucing
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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
        <div x-show="open" x-transition class="bg-white rounded-3xl overflow-hidden max-w-lg w-full mx-4 relative z-10 shadow-2xl flex flex-col">
            <button @click="open = false" class="absolute top-4 right-4 p-2 text-slate-600 bg-white/50 backdrop-blur rounded-full hover:bg-white transition-colors z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <div class="h-64 w-full bg-slate-100 relative group">
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
                <h3 x-text="cat.name" class="text-3xl font-extrabold text-slate-900 mb-1"></h3>
                <div class="flex gap-2 mb-6">
                    <span x-text="cat.breed" class="text-xs font-bold bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg"></span>
                    <span x-text="cat.age + ' Bulan'" class="text-xs font-bold bg-amber-100 text-amber-700 px-3 py-1.5 rounded-lg"></span>
                </div>
                
                <h4 class="text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Kondisi & Kepribadian</h4>
                <p x-text="cat.condition" class="text-slate-600 text-sm leading-relaxed mb-8"></p>
                
                <button @click="open = false" class="w-full py-3.5 rounded-xl bg-slate-100 text-slate-800 font-bold hover:bg-slate-200 transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection
