@extends('layouts.dashboard')
@section('title', 'Program Donasi')
@section('page-title', 'Program Donasi')
@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <div class="bg-white shadow-sm p-5 border-l-4 border-green-500">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Aktif</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalAktif }}</p>
        </div>
        <div class="bg-white shadow-sm p-5 border-l-4 border-gray-400">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Nonaktif</p>
            <p class="text-3xl font-bold text-gray-500">{{ $totalNonaktif }}</p>
        </div>
        <div class="bg-white shadow-sm p-5 border-l-4 border-primary">
            <p class="text-xs font-bold uppercase text-gray-400 mb-1">Total Program</p>
            <p class="text-3xl font-bold text-primary">{{ $totalAktif + $totalNonaktif }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex gap-2">
            <a href="{{ route('penulis.program-donasi.index') }}"
               class="px-4 py-2 text-xs font-bold uppercase no-round transition {{ !request('status') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Aktif
            </a>
            <a href="{{ route('penulis.program-donasi.index', ['status' => 'terhapus']) }}"
               class="px-4 py-2 text-xs font-bold uppercase no-round transition {{ request('status') === 'terhapus' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Terhapus
            </a>
        </div>
        <a href="{{ route('penulis.program-donasi.create') }}"
           class="bg-primary text-white px-6 py-3 font-bold uppercase text-sm hover:bg-red-700 transition no-round">
            <i class="fas fa-plus mr-2"></i>Tambah Program
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-bold uppercase text-gray-500">
                    <th class="px-5 py-4">Cover</th>
                    <th class="px-5 py-4">Program</th>
                    <th class="px-5 py-4">Target</th>
                    <th class="px-5 py-4">Donasi</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-center w-16"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $p)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <img src="{{ $p->gambar }}" alt="{{ $p->judul }}" class="w-16 h-12 object-cover">
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800">{{ $p->judul }}</p>
                            <p class="text-xs text-gray-400 line-clamp-1">{{ Str::limit(strip_tags($p->deskripsi), 80) }}</p>
                        </td>
                        <td class="px-5 py-4 text-gray-700">
                            {{ $p->target_format ?? '-' }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-primary">{{ $p->donasi_count }}</span>
                            <span class="text-xs text-gray-400">donasi</span>
                        </td>
                        <td class="px-5 py-4">
                            @if ($p->trashed())
                                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-red-100 text-red-600">Terhapus</span>
                            @elseif ($p->is_active)
                                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-green-100 text-green-700">Aktif</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-gray-100 text-gray-500">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" @click.outside="open = false" type="button"
                                        class="text-gray-500 hover:text-dark transition p-2">
                                    <i class="fas fa-ellipsis-vertical text-lg"></i>
                                </button>
                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-1 w-44 bg-white border border-gray-200 shadow-lg z-20 no-round">
                                    @if ($p->trashed())
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Pulihkan Program', message: 'Data akan dipulihkan ke daftar aktif.', action: '{{ route('penulis.program-donasi.restore', $p->id) }}', method: 'PATCH', buttonText: 'Pulihkan', buttonColor: 'green' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition">
                                            <i class="fas fa-undo w-4 text-center"></i> Pulihkan
                                        </button>
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Hapus Permanen', message: 'Data akan dihapus permanen dan tidak dapat dipulihkan kembali!', action: '{{ route('penulis.program-donasi.force-delete', $p->id) }}', method: 'DELETE', buttonText: 'Hapus Permanen' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-trash-alt w-4 text-center"></i> Hapus Permanen
                                        </button>
                                    @else
                                        <a href="{{ route('penulis.program-donasi.edit', $p->id) }}"
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                                            <i class="fas fa-edit w-4 text-center text-secondary"></i> Edit
                                        </a>
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Hapus Program Donasi', message: 'Program ini akan dihapus. Data yang dihapus dapat dipulihkan.', action: '{{ route('penulis.program-donasi.destroy', $p->id) }}', method: 'DELETE' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-trash w-4 text-center"></i> Hapus
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-gray-400 text-sm">
                            <i class="fas fa-hand-holding-heart text-3xl mb-3 block"></i>
                            Belum ada program donasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($programs->hasPages())
        <div class="mt-4">{{ $programs->links() }}</div>
    @endif

@endsection
