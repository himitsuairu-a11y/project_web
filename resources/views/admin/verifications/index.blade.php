@extends('layouts.admin')

@section('title', 'Verifikasi Pengambilan')
@section('header', 'Verifikasi Pengambilan')

@section('content')
    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm max-w-xl mx-auto text-center">
        
        <div class="w-20 h-20 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>

        <h3 class="text-2xl font-extrabold text-slate-800 mb-2">Verifikasi Kode Pengambilan</h3>
        <p class="text-slate-500 mb-8">Masukkan Order Code yang dibawa oleh Adopter untuk menyelesaikan proses adopsi.</p>

        <form action="{{ route('admin.verify.submit') }}" method="POST">
            @csrf
            <div class="mb-6 relative">
                <input type="text" name="order_code" id="order_code" required placeholder="Contoh: ADPT-XYZ123" 
                    class="w-full text-center text-2xl font-mono px-6 py-4 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-0 transition-colors uppercase tracking-widest placeholder-slate-300">
            </div>
            
            <button type="submit" class="w-full px-6 py-4 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-lg shadow-lg shadow-brand-500/30 hover:-translate-y-0.5 transition-all duration-300">
                Verifikasi Pengambilan
            </button>
        </form>
    </div>
@endsection
