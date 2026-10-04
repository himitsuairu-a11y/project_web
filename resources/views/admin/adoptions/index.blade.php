@extends('layouts.admin')

@section('title', 'Pengajuan Adopsi')
@section('header', 'Manajemen Pengajuan Adopsi')

@section('content')
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="text-xl font-extrabold text-slate-800 mb-6">Daftar Pengajuan Adopsi</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kucing</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Adopter</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status & Order</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($adoptions as $adoption)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                                        <img src="{{ Storage::url($adoption->cat->photo_path) }}" alt="Foto" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $adoption->cat->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $adoption->cat->breed }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-4 align-top">
                                <p class="font-bold text-slate-800 text-sm">{{ $adoption->applicant_name ?? $adoption->user->name }}</p>
                                <p class="text-xs text-slate-500 mb-2">{{ $adoption->applicant_address }}</p>
                                
                                <div class="flex gap-2 mb-2">
                                    @if($adoption->identity_card_path)
                                    <a href="{{ Storage::url($adoption->identity_card_path) }}" target="_blank" class="text-[10px] bg-indigo-50 text-indigo-600 font-bold px-2 py-1 rounded hover:bg-indigo-100 transition-colors">
                                        Lihat KTP
                                    </a>
                                    @endif
                                    @if($adoption->salary_slip_path)
                                    <a href="{{ Storage::url($adoption->salary_slip_path) }}" target="_blank" class="text-[10px] bg-teal-50 text-teal-600 font-bold px-2 py-1 rounded hover:bg-teal-100 transition-colors">
                                        Lihat Slip Gaji
                                    </a>
                                    @endif
                                </div>
                                <p class="text-[11px] text-slate-500 max-w-[200px] bg-slate-50 p-2 rounded line-clamp-2" title="{{ $adoption->adoption_reason }}">
                                    "{{ $adoption->adoption_reason }}"
                                </p>
                            </td>

                            <td class="p-4">
                                @php
                                    $statusColors = [
                                        \App\Enums\AdoptionStatus::PENDING->value => 'bg-amber-100 text-amber-700 dot-amber-500',
                                        \App\Enums\AdoptionStatus::APPROVED->value => 'bg-blue-100 text-blue-700 dot-blue-500',
                                        \App\Enums\AdoptionStatus::REJECTED->value => 'bg-rose-100 text-rose-700 dot-rose-500',
                                        \App\Enums\AdoptionStatus::COMPLETED->value => 'bg-emerald-100 text-emerald-700 dot-emerald-500',
                                    ];
                                    $colorClass = $statusColors[$adoption->status->value] ?? 'bg-slate-100 text-slate-700 dot-slate-500';
                                    
                                    // Extract dot color class
                                    preg_match('/dot-([a-z]+-[0-9]+)/', $colorClass, $matches);
                                    $dotColor = $matches ? 'bg-'.$matches[1] : 'bg-slate-500';
                                    $bgTextClass = preg_replace('/dot-[a-z]+-[0-9]+/', '', $colorClass);
                                @endphp
                                
                                <div class="mb-1">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full {{ trim($bgTextClass) }} text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                        {{ $adoption->status->value }}
                                    </span>
                                </div>
                                <p class="text-[11px] font-mono font-bold text-slate-400">Order: {{ $adoption->order_code ?? '-' }}</p>
                            </td>
                            
                            <td class="p-4 text-right">
                                @if($adoption->status === \App\Enums\AdoptionStatus::PENDING)
                                        <form action="{{ route('admin.adoptions.approve', $adoption->id) }}" method="POST" class="flex flex-col gap-2 items-end">
                                            @csrf
                                            <input type="datetime-local" name="pickup_datetime" required class="text-xs px-2 py-1 rounded border border-slate-200 focus:ring-brand-500 focus:border-brand-500 w-[140px]">
                                            <div class="flex gap-2">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold transition-colors">
                                                    Approve
                                                </button>
                                                <button type="button" onclick="event.preventDefault(); document.getElementById('reject-form-{{$adoption->id}}').submit();" class="px-3 py-1.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold transition-colors">
                                                    Reject
                                                </button>
                                            </div>
                                        </form>
                                        <form id="reject-form-{{$adoption->id}}" action="{{ route('admin.adoptions.reject', $adoption->id) }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">No Actions Available</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500 text-sm">Belum ada pengajuan adopsi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
