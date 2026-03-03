{{-- Reusable CRUD Index Table --}}
{{-- Usage: @include('partials.crud-index', ['title' => '...', 'createRoute' => '...', 'columns' => [...], 'rows' => [...], 'paginator' => $model]) --}}

<div class="bg-white shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <form method="GET" class="relative w-full sm:w-80">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-search"></i></span>
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari {{ strtolower($title) }}..." class="w-full border border-gray-300 p-3 pl-12 text-base focus:border-primary focus:outline-none transition no-round">
        </form>
        <div class="flex gap-2">
            @if (isset($trashedRoute))
                @if (request('status') === 'terhapus')
                    <a href="{{ $trashedRoute }}" class="bg-gray-600 text-white px-4 py-3 font-bold text-base hover:bg-gray-700 transition no-round whitespace-nowrap">
                        <i class="fas fa-list mr-1"></i> Semua
                    </a>
                @else
                    <a href="{{ $trashedRoute }}?status=terhapus" class="bg-gray-600 text-white px-4 py-3 font-bold text-base hover:bg-gray-700 transition no-round whitespace-nowrap">
                        <i class="fas fa-trash-alt mr-1"></i> Terhapus
                    </a>
                @endif
            @endif
            @if (isset($createRoute) && request('status') !== 'terhapus')
                <a href="{{ $createRoute }}" class="bg-primary text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Tambah {{ $title }}
                </a>
            @endif
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b-2 border-primary">
                    <th class="p-4 text-base font-bold uppercase text-gray-600 w-12">No</th>
                    @foreach ($columns as $col)
                        <th class="p-4 text-base font-bold uppercase text-gray-600">{{ $col }}</th>
                    @endforeach
                    <th class="p-4 text-base font-bold uppercase text-gray-600 text-center w-16"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $i => $row)
                    <tr class="border-b hover:bg-gray-50 transition {{ isset($row['trashed']) && $row['trashed'] ? 'bg-red-50' : '' }}">
                        <td class="p-4 text-base">{{ isset($paginator) ? $paginator->firstItem() + $i : $i + 1 }}</td>
                        @foreach ($row['cells'] as $cell)
                            <td class="p-4 text-base">{!! $cell !!}</td>
                        @endforeach
                        <td class="p-4 text-center">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" @click.outside="open = false" type="button"
                                        class="text-gray-500 hover:text-dark transition p-2">
                                    <i class="fas fa-ellipsis-vertical text-lg"></i>
                                </button>
                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-1 w-44 bg-white border border-gray-200 shadow-lg z-20 no-round">
                                    @if (isset($row['editRoute']))
                                        <a href="{{ $row['editRoute'] }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                                            <i class="fas fa-edit w-4 text-center text-secondary"></i> Edit
                                        </a>
                                    @endif
                                    @if (isset($row['deleteRoute']))
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Hapus Data', message: 'Data yang dihapus dapat dipulihkan dari menu Terhapus.', action: '{{ $row['deleteRoute'] }}', method: 'DELETE' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-trash w-4 text-center"></i> Hapus
                                        </button>
                                    @endif
                                    @if (isset($row['restoreRoute']))
                                        <button type="button" @click="open = false; $dispatch('confirm-action', { title: 'Pulihkan Data', message: 'Data akan dipulihkan ke daftar aktif.', action: '{{ $row['restoreRoute'] }}', method: 'PATCH', buttonText: 'Pulihkan', buttonColor: 'green' })"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-green-600 hover:bg-green-50 transition">
                                            <i class="fas fa-undo w-4 text-center"></i> Pulihkan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 2 }}" class="p-8 text-center text-gray-400 text-base">
                            <i class="fas fa-inbox text-3xl mb-3 block"></i>
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($paginator) && $paginator->hasPages())
        <div class="mt-6">
            {{ $paginator->links() }}
        </div>
    @elseif (isset($paginator))
        <div class="mt-6 text-base text-gray-500">
            <p>Menampilkan {{ $paginator->total() }} data</p>
        </div>
    @endif
</div>
