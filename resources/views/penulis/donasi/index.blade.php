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

    {{-- Filter Status & Program --}}
    <form method="GET" action="{{ route('penulis.donasi.index') }}"
          class="bg-white shadow-sm p-4 mb-6 flex flex-wrap gap-3 items-end">
        @if (request('cari'))
            <input type="hidden" name="cari" value="{{ request('cari') }}">
        @endif

        {{-- Dropdown Status --}}
        <div class="flex flex-col gap-1">
            <label class="text-xs font-bold uppercase text-gray-400">Status</label>
            <select name="status"
                    class="border border-gray-300 text-sm text-gray-700 px-3 py-2 focus:border-primary focus:outline-none transition no-round bg-white"
                    onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending"       {{ request('status') === 'pending'       ? 'selected' : '' }}>Pending</option>
                <option value="dikonfirmasi"  {{ request('status') === 'dikonfirmasi'  ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="ditolak"       {{ request('status') === 'ditolak'       ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        {{-- Dropdown Program --}}
        @if ($programs->isNotEmpty())
        <div class="flex flex-col gap-1">
            <label class="text-xs font-bold uppercase text-gray-400">Program</label>
            <select name="program"
                    class="border border-gray-300 text-sm text-gray-700 px-3 py-2 focus:border-primary focus:outline-none transition no-round bg-white"
                    onchange="this.form.submit()">
                <option value="">Semua Program</option>
                @foreach ($programs as $prog)
                    <option value="{{ $prog->id }}" {{ request('program') == $prog->id ? 'selected' : '' }}>
                        {{ $prog->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
    </form>

    {{-- Table --}}
    <div class="bg-white shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-bold uppercase text-gray-500">
                    <th class="px-5 py-4">Donatur</th>
                    <th class="px-5 py-4">Program</th>
                    <th class="px-5 py-4">Jumlah</th>
                    <th class="px-5 py-4">Tanggal</th>
                    <th class="px-5 py-4 text-center">Bukti</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donasi as $d)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800">{{ $d->nama_tampil }}</p>
                            @if (!$d->is_anonim)
                                <p class="text-xs text-gray-400">{{ $d->email }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            @if ($d->programDonasi)
                                <span class="text-xs font-semibold text-gray-700">{{ Str::limit($d->programDonasi->judul, 30) }}</span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-primary font-bold">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-5 py-4 text-gray-500 text-xs">
                            {{ $d->tanggal ? \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d M Y') : $d->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if ($d->bukti_transfer)
                                <a href="{{ route('penulis.donasi.bukti-transfer', $d->id) }}" target="_blank"
                                   title="Lihat bukti transfer"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                                   onclick="event.stopPropagation()">
                                    <i class="fas fa-file-image text-sm"></i>
                                </a>
                            @else
                                <span class="text-gray-300" title="Tidak ada bukti"><i class="fas fa-minus text-xs"></i></span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold uppercase
                                {{ $d->status === 'dikonfirmasi' ? 'bg-green-100 text-green-700' :
                                   ($d->status === 'ditolak' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $d->status_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('penulis.donasi.show', $d->id) }}"
                               class="inline-flex items-center gap-1 bg-primary text-white px-4 py-2 text-xs font-bold uppercase hover:bg-red-700 transition no-round">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-gray-400 text-sm">
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
