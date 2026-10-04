@extends('layouts.user')

@section('title', 'Katalog Hewan Tersedia')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600">Siap Diadopsi</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">Pilih Sahabat Barumu</h1>
            <p class="text-slate-500 mt-4 text-sm sm:text-base">Temukan sahabat bulumu di bawah ini. Jika ada pertanyaan, jangan ragu untuk menghubungi shelter kami.</p>
        </div>

        <!-- Filter Form -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-12">
            <form action="{{ url('/catalog') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="breed" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Ras Kucing</label>
                    <input type="text" name="breed" id="breed" value="{{ request('breed') }}" placeholder="Contoh: Persia, Anggora..." 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 transition-shadow text-sm">
                </div>
                <div class="flex-1 w-full">
                    <label for="age" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Umur Maksimal (Bulan)</label>
                    <input type="number" name="age" id="age" value="{{ request('age') }}" placeholder="Contoh: 12" min="1"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 transition-shadow text-sm">
                </div>
                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full md:w-auto px-8 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-brand-600 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Catalog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($cats as $cat)
                <div class="bg-white rounded-[2rem] overflow-hidden border border-slate-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="relative h-64 overflow-hidden bg-slate-100">
                        <img src="{{ Storage::url($cat->photo_path) }}" alt="Foto Kucing" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                            {{ $cat->age_in_months }} Bulan
                        </span>
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3.5 py-1 rounded-full text-xs font-bold text-slate-900">
                            {{ $cat->breed }}
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-2xl font-extrabold text-slate-900">{{ $cat->name }}</h3>
                            @if($cat->status === \App\Enums\CatStatus::AVAILABLE)
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-lg">Tersedia</span>
                            @endif
                        </div>
                        
                        <p class="text-sm text-slate-500 mb-6 leading-relaxed line-clamp-3">
                            {{ $cat->condition }}
                        </p>
                        
                        @auth
                            <div class="flex gap-2">
                                <button @click="$dispatch('open-detail', {{ json_encode([
                                    'name' => $cat->name,
                                    'breed' => $cat->breed,
                                    'age' => $cat->age_in_months,
                                    'condition' => $cat->condition,
                                    'photo' => Storage::url($cat->photo_path),
                                    'photos' => $cat->photos ? array_map(fn($p) => Storage::url($p), $cat->photos) : []
                                ]) }})" class="flex-1 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all">Detail</button>
                                <button onclick="openAdoptionModal({{ $cat->id }}, '{{ $cat->name }}')" class="flex-[2] py-3.5 rounded-xl bg-slate-100 text-slate-800 font-bold group-hover:bg-gradient-to-r group-hover:from-amber-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300 shadow-sm shadow-orange-500/0 group-hover:shadow-orange-500/25">
                                    Adopsi
                                </button>
                            </div>
                        @else
                            <div class="flex gap-2">
                                <button @click="$dispatch('open-detail', {{ json_encode([
                                    'name' => $cat->name,
                                    'breed' => $cat->breed,
                                    'age' => $cat->age_in_months,
                                    'condition' => $cat->condition,
                                    'photo' => Storage::url($cat->photo_path),
                                    'photos' => $cat->photos ? array_map(fn($p) => Storage::url($p), $cat->photos) : []
                                ]) }})" class="flex-1 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all">Detail</button>
                                <a href="{{ route('login') }}" class="flex-[2] block text-center py-3.5 rounded-xl bg-slate-100 text-slate-800 font-bold hover:bg-slate-200 transition-all duration-300">
                                    Login Adopsi
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">😿</div>
                    <p class="text-lg font-bold text-slate-800">Tidak ada kucing yang sesuai filter.</p>
                    <p class="text-slate-500">Coba ubah filter pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $cats->links() }}
        </div>
    </div>

    <!-- Adoption Modal (Alpine JS optional, but using vanilla JS for simplicity) -->
    @auth
    <div id="adoptionModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAdoptionModal()"></div>
        
        <!-- Modal Content -->
        <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 relative z-10 shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
            <button onclick="closeAdoptionModal()" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 bg-slate-100 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Ajukan Adopsi</h3>
            <p class="text-slate-500 text-sm mb-6">Ceritakan alasan Anda mengapa ingin mengadopsi <span id="modalCatName" class="font-bold text-brand-600"></span>.</p>
            
            <form action="{{ route('user.adoptions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cat_id" id="modalCatId">
                
                <div class="mb-4">
                    <label for="applicant_name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="applicant_name" id="applicant_name" required value="{{ auth()->user()->name }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 transition-shadow text-sm">
                </div>

                <div class="mb-4">
                    <label for="applicant_address" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat Domisili</label>
                    <textarea name="applicant_address" id="applicant_address" rows="2" required placeholder="Alamat lengkap tempat tinggal saat ini..." 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 transition-shadow text-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="identity_card" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload KTP</label>
                        <input type="file" name="identity_card" id="identity_card" required accept=".jpg,.jpeg,.png,.pdf"
                            class="w-full px-4 py-2.5 bg-slate-50 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                    </div>
                    <div>
                        <label for="salary_slip" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload Slip Gaji</label>
                        <input type="file" name="salary_slip" id="salary_slip" required accept=".jpg,.jpeg,.png,.pdf"
                            class="w-full px-4 py-2.5 bg-slate-50 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="reason" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alasan Adopsi & Pengalaman</label>
                    <textarea name="reason" id="reason" rows="3" required placeholder="Tuliskan pengalaman Anda memelihara hewan dan komitmen Anda..." 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500 transition-shadow text-sm"></textarea>
                </div>
                
                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all">
                    Kirim Pengajuan
                </button>
            </form>
        </div>
    </div>
    @endauth

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

    <script>
        function openAdoptionModal(catId, catName) {
            const modal = document.getElementById('adoptionModal');
            const content = document.getElementById('modalContent');
            
            document.getElementById('modalCatId').value = catId;
            document.getElementById('modalCatName').innerText = catName;
            
            modal.classList.remove('hidden');
            // Small delay to allow display:block to apply before animating opacity
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAdoptionModal() {
            const modal = document.getElementById('adoptionModal');
            const content = document.getElementById('modalContent');
            
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }


    </script>
@endsection
