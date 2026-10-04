@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
        <div>
            <h3 class="text-lg font-extrabold text-slate-800">Daftar Adopter</h3>
            <p class="text-slate-500 text-sm mt-1">Kelola data pengguna terdaftar di sistem.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="p-4 font-bold border-b border-slate-200">User</th>
                    <th class="p-4 font-bold border-b border-slate-200">Kontak</th>
                    <th class="p-4 font-bold border-b border-slate-200">Pekerjaan / Gaji</th>
                    <th class="p-4 font-bold border-b border-slate-200 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="p-4">
                            <div class="font-bold text-slate-800">{{ $user->name }}</div>
                            <div class="text-sm text-slate-500">Bergabung: {{ $user->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="p-4">
                            <div class="text-sm text-slate-800">{{ $user->email }}</div>
                            <div class="text-sm text-slate-500">{{ $user->phone_number ?? '-' }}</div>
                        </td>
                        <td class="p-4">
                            <div class="text-sm text-slate-800">{{ $user->job ?? '-' }}</div>
                            <div class="text-sm font-semibold text-emerald-600">{{ $user->salary ? 'Rp ' . number_format($user->salary, 0, ',', '.') : '-' }}</div>
                        </td>
                        <td class="p-4 text-right">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini secara permanen? Semua data adopsi miliknya mungkin akan ikut terhapus.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-colors" title="Hapus User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800 mb-1">Belum ada Pengguna</h3>
                                <p class="text-slate-500 text-sm max-w-sm">Belum ada adopter yang terdaftar di sistem ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
