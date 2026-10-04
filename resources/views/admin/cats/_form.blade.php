<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="col-span-1 md:col-span-2">
        <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Nama Kucing</label>
        <input type="text" name="name" id="name" value="{{ old('name', $cat->name ?? '') }}" required 
            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">
    </div>

    <div>
        <label for="breed" class="block text-sm font-bold text-slate-700 mb-1">Ras Kucing</label>
        <input type="text" name="breed" id="breed" value="{{ old('breed', $cat->breed ?? '') }}" required 
            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">
    </div>

    <div>
        <label for="age_in_months" class="block text-sm font-bold text-slate-700 mb-1">Umur (Bulan)</label>
        <input type="number" name="age_in_months" id="age_in_months" value="{{ old('age_in_months', $cat->age_in_months ?? '') }}" required min="0" 
            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">
    </div>

    <div class="col-span-1 md:col-span-2">
        <label for="condition" class="block text-sm font-bold text-slate-700 mb-1">Kondisi Fisik / Kesehatan</label>
        <textarea name="condition" id="condition" rows="3" required 
            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">{{ old('condition', $cat->condition ?? '') }}</textarea>
    </div>

    <div class="col-span-1 md:col-span-2">
        <label for="photos" class="block text-sm font-bold text-slate-700 mb-1">Foto Kucing (Bisa lebih dari 1)</label>
        
        <!-- Display Existing Main Photo -->
            <div class="mb-3 flex flex-wrap gap-3">
                <!-- Display All Photos -->
                @if(isset($cat) && is_array($cat->photos))
                    @foreach($cat->photos as $index => $photoPath)
                        <div class="relative group cursor-pointer" x-data="{ deleted: false }">
                            <img src="{{ Storage::url($photoPath) }}" alt="Foto Kucing" class="w-32 h-32 object-cover rounded-xl shadow-sm border-2 transition-all duration-300" :class="deleted ? 'border-rose-500 opacity-50 grayscale' : 'border-slate-200 group-hover:border-rose-300'">
                            
                            @if($index === 0)
                            <div class="absolute bottom-0 left-0 right-0 bg-black/50 py-1 text-center" x-show="!deleted">
                                <span class="text-white text-[10px] font-bold">Utama</span>
                            </div>
                            @endif

                            <label class="absolute top-2 right-2 bg-white/90 backdrop-blur rounded-full p-1.5 shadow-sm cursor-pointer text-slate-400 hover:text-rose-500 hover:bg-white transition-colors" :class="deleted ? 'text-rose-600 bg-rose-100 ring-2 ring-rose-500' : ''">
                                <input type="checkbox" name="delete_photos[]" value="{{ $photoPath }}" class="hidden" @change="deleted = !deleted">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </label>

                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none" x-show="deleted" style="display: none;">
                                <span class="bg-rose-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">Akan Dihapus</span>
                            </div>
                        </div>
                    @endforeach
                @elseif(isset($cat) && $cat->photo_path)
                    <div class="relative group cursor-pointer" x-data="{ deleted: false }">
                        <img src="{{ Storage::url($cat->photo_path) }}" alt="Foto Utama" class="w-32 h-32 object-cover rounded-xl shadow-sm border-2 transition-all duration-300" :class="deleted ? 'border-rose-500 opacity-50 grayscale' : 'border-brand-500'">
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 py-1 text-center" x-show="!deleted">
                            <span class="text-white text-[10px] font-bold">Utama</span>
                        </div>
                        <label class="absolute top-2 right-2 bg-white/90 backdrop-blur rounded-full p-1.5 shadow-sm cursor-pointer text-slate-400 hover:text-rose-500 hover:bg-white transition-colors" :class="deleted ? 'text-rose-600 bg-rose-100 ring-2 ring-rose-500' : ''">
                            <input type="checkbox" name="delete_photos[]" value="{{ $cat->photo_path }}" class="hidden" @change="deleted = !deleted">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </label>
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none" x-show="deleted" style="display: none;">
                            <span class="bg-rose-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">Akan Dihapus</span>
                        </div>
                    </div>
                @endif
            </div>

        <input type="file" name="photos[]" id="photos" accept="image/jpeg,image/png,image/jpg" multiple {{ isset($cat) ? '' : 'required' }} 
            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-colors">
        <p class="mt-1 text-xs text-slate-400">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</p>
    </div>
</div>
