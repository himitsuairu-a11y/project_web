@extends('layouts.admin')

@section('title', 'Edit Data Kucing')
@section('header', 'Edit Data Kucing')

@section('content')
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm max-w-3xl">
        <form action="{{ route('admin.cats.update', $cat->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.cats._form', ['cat' => $cat])
            
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold transition-all shadow-md shadow-brand-500/20">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.cats.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
