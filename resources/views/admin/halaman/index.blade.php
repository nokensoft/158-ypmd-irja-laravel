@extends('layouts.dashboard')
@section('title', 'Manajemen Halaman')
@section('page-title', 'Manajemen Halaman')
@section('content')

    {{-- Actions --}}
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex gap-2">
            <a href="{{ route('admin.halaman.index') }}"
               class="px-4 py-2 text-xs font-bold uppercase no-round transition {{ !request('status') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Aktif
            </a>
            <a href="{{ route('admin.halaman.index', ['status' => 'terhapus']) }}"
               class="px-4 py-2 text-xs font-bold uppercase no-round transition {{ request('status') === 'terhapus' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Terhapus
            </a>
        </div>
        <a href="{{ route('admin.halaman.create') }}"
           class="bg-primary text-white px-6 py-3 font-bold uppercase text-sm hover:bg-red-700 transition no-round">
            <i class="fas fa-plus mr-2"></i>Tambah Halaman
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-bold uppercase text-gray-500">
                    <th class="px-5 py-4 w-16">Urutan</th>
                    <th class="px-5 py-4">Judul</th>
                    <th class="px-5 py-4">Slug</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-center w-16"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($halaman as $h)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="px-5 py-4 text-center font-bold text-gray-400">{{ $h->urutan }}</td>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800">{{ $h->judul }}</p>
                            @if ($h->keterangan)
                                <p class="text-xs text-gray-400 line-clamp-1">{{ $h->keterangan }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <code class="text-xs bg-gray-100 px-2 py-1 text-gray-600">/halaman/{{ $h->slug }}</code>
                        </td>
                        <td class="px-5 py-4">
                            @if ($h->trashed())
                                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-red-100 text-red-600">Terhapus</span>
                            @elseif ($h->is_active)
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
                                    @if ($h->trashed())
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Pulihkan Halaman', message: 'Data akan dipulihkan ke daftar aktif.', action: '{{ route('admin.halaman.restore', $h->id) }}', method: 'PATCH', buttonText: 'Pulihkan', buttonColor: 'green' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition">
                                            <i class="fas fa-undo w-4 text-center"></i> Pulihkan
                                        </button>
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Hapus Permanen', message: 'Data akan dihapus permanen dan tidak dapat dipulihkan kembali!', action: '{{ route('admin.halaman.force-delete', $h->id) }}', method: 'DELETE', buttonText: 'Hapus Permanen' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-trash-alt w-4 text-center"></i> Hapus Permanen
                                        </button>
                                    @else
                                        <a href="{{ route('halaman.show', $h->slug) }}" target="_blank"
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                                            <i class="fas fa-eye w-4 text-center text-gray-400"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.halaman.edit', $h->id) }}"
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                                            <i class="fas fa-edit w-4 text-center text-secondary"></i> Edit
                                        </a>
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Hapus Halaman', message: 'Halaman ini akan dihapus. Data yang dihapus dapat dipulihkan.', action: '{{ route('admin.halaman.destroy', $h->id) }}', method: 'DELETE' })"
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
                        <td colspan="5" class="px-5 py-12 text-center text-gray-400 text-sm">
                            <i class="fas fa-file-alt text-3xl mb-3 block"></i>
                            Belum ada halaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($halaman->hasPages())
        <div class="mt-4">{{ $halaman->links() }}</div>
    @endif

@endsection
