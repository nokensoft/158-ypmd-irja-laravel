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
                    <th class="px-5 py-4 text-right">Aksi</th>
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
                        <td class="px-5 py-4 text-right">
                            @if ($h->trashed())
                                <form action="{{ route('admin.halaman.restore', $h->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 text-xs font-bold uppercase hover:bg-green-700 transition no-round">
                                        <i class="fas fa-undo mr-1"></i>Pulihkan
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('halaman.show', $h->slug) }}" target="_blank"
                                   class="inline-flex items-center gap-1 bg-gray-200 text-gray-700 px-3 py-2 text-xs font-bold uppercase hover:bg-gray-300 transition no-round">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.halaman.edit', $h->id) }}"
                                   class="inline-flex items-center gap-1 bg-primary text-white px-4 py-2 text-xs font-bold uppercase hover:bg-red-700 transition no-round">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.halaman.destroy', $h->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus halaman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 text-xs font-bold uppercase hover:bg-red-700 transition no-round">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
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
