@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-extrabold text-slate-800">Profil Saya</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola informasi data diri dan dokumen identitas Anda.</p>
        </div>

        <div class="p-8">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon/WA</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pekerjaan</label>
                        <input type="text" name="job" value="{{ old('job', $user->job) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Penghasilan Per Bulan (Rp)</label>
                        <input type="number" name="salary" value="{{ old('salary', $user->salary) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Scan KTP</label>
                        @if($user->id_card_path)
                            <div class="mb-3">
                                <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded font-bold">✓ Sudah Diupload</span>
                            </div>
                        @endif
                        <input type="file" name="id_card" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Slip Gaji (Opsional)</label>
                        @if($user->salary_slip_path)
                            <div class="mb-3">
                                <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded font-bold">✓ Sudah Diupload</span>
                            </div>
                        @endif
                        <input type="file" name="salary_slip" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-colors">
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Ganti Password (Opsional)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors">
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 transition-all duration-300 hover:-translate-y-0.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
