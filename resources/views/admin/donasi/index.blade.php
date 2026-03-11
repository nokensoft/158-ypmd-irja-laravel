@extends('layouts.dashboard')
@section('title', 'Manajemen Donasi')
@section('page-title', 'Manajemen Donasi')
@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white shadow-sm p-5 border-l-4 border-yellow-400">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $statsPending }}</p>
        </div>
        <div class="bg-white shadow-sm p-5 border-l-4 border-green-500">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Dikonfirmasi</p>
            <p class="text-3xl font-bold text-green-600">{{ $statsDikonfirmasi }}</p>
        </div>
        <div class="bg-white shadow-sm p-5 border-l-4 border-red-400">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Ditolak</p>
            <p class="text-3xl font-bold text-red-500">{{ $statsDitolak }}</p>
        </div>
        <div class="bg-white shadow-sm p-5 border-l-4 border-primary">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Total Donasi</p>
            <p class="text-2xl font-bold text-primary">Rp {{ number_format($statsTotal, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Filter Status --}}
    <div class="bg-white shadow-sm p-4 mb-6 flex flex-wrap gap-2 items-center">
        <span class="text-xs font-bold uppercase text-gray-400 mr-2">Filter:</span>
        @foreach (['semua' => 'Semua', 'pending' => 'Pending', 'dikonfirmasi' => 'Dikonfirmasi', 'ditolak' => 'Ditolak'] as $val => $label)
            <a href="{{ route('admin.donasi.index', ['status' => $val === 'semua' ? null : $val]) }}"
               class="px-4 py-2 text-xs font-bold uppercase no-round transition
                      {{ request('status', 'semua') === $val
                          ? 'bg-primary text-white'
                          : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-bold uppercase text-gray-500">
                    <th class="px-5 py-4">Donatur</th>
                    <th class="px-5 py-4">Bank / Jumlah</th>
                    <th class="px-5 py-4">Tanggal</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donasi as $d)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800">{{ $d->nama_donatur }}</p>
                            <p class="text-xs text-gray-400">{{ $d->email }}</p>
                            @if ($d->telepon)
                                <p class="text-xs text-gray-400">{{ $d->telepon }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-700">{{ $d->bank }}</p>
                            <p class="text-primary font-bold">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-5 py-4 text-gray-500 text-xs">
                            {{ $d->tanggal ? \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d M Y') : $d->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold uppercase
                                {{ $d->status === 'dikonfirmasi' ? 'bg-green-100 text-green-700' :
                                   ($d->status === 'ditolak' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $d->status_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.donasi.show', $d->id) }}"
                               class="inline-flex items-center gap-1 bg-primary text-white px-4 py-2 text-xs font-bold uppercase hover:bg-red-700 transition no-round">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-gray-400 text-sm">
                            <i class="fas fa-inbox text-3xl mb-3 block"></i>
                            Belum ada data donasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($donasi->hasPages())
        <div class="mt-4">
            {{ $donasi->appends(request()->query())->links() }}
        </div>
    @endif

@endsection
