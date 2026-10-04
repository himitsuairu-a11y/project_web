@extends('layouts.admin')

@section('title', 'Pengaturan Web')
@section('header', 'Pengaturan Web')

@section('content')
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm max-w-3xl">
        
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-xl font-semibold flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-1 border-b border-slate-100 pb-2">Kontak Live Chat (WhatsApp)</h3>
                <p class="text-sm text-slate-500 mb-4">Pengaturan ini akan mengubah tombol WhatsApp mengambang (floating) di landing page.</p>
                
                <div class="space-y-4">
                    <div>
                        <label for="wa_number" class="block text-sm font-bold text-slate-700 mb-1">Nomor WhatsApp</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm font-bold">
                                +62
                            </span>
                            <input type="text" name="wa_number" id="wa_number" value="{{ old('wa_number', preg_replace('/^62/', '', $wa_number)) }}" placeholder="81234567890" required 
                                class="flex-1 min-w-0 block w-full px-4 py-2.5 rounded-none rounded-r-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Mulai dengan angka 8, tanpa awalan 0 atau 62 (contoh: 81234567890).</p>
                    </div>

                    <div>
                        <label for="wa_message" class="block text-sm font-bold text-slate-700 mb-1">Pesan Default</label>
                        <textarea name="wa_message" id="wa_message" rows="3" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-shadow">{{ old('wa_message', $wa_message) }}</textarea>
                        <p class="text-xs text-slate-400 mt-1">Pesan ini akan otomatis terisi saat pengguna mengklik tombol chat.</p>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold transition-all shadow-md shadow-brand-500/20">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection
