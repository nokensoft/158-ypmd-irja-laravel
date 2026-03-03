@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Galeri' : 'Tambah Galeri')
@section('page-title', $editMode ? 'Edit Galeri' : 'Tambah Galeri')
@section('content')
    @php
        $selectedIds = old('media_ids', $editMode ? $galeri->media->pluck('id')->toArray() : []);
    @endphp
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.galeri.update', $galeri->id) : route('penulis.galeri.store') }}" method="POST" class="space-y-6">
            @csrf
            @if ($editMode) @method('PUT') @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-4xl">
                {{-- Judul --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul Album</label>
                    <input type="text" name="judul" value="{{ old('judul', $editMode ? $galeri->judul : '') }}" required
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Judul album galeri">
                    @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Kategori</label>
                    <select name="kategori" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                        <option value="">Pilih Kategori</option>
                        @foreach (\App\Models\Galeri::KATEGORI_LIST as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $editMode ? $galeri->kategori : '') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="max-w-4xl">
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none"
                          placeholder="Deskripsi album (opsional)">{{ old('deskripsi', $editMode ? $galeri->deskripsi : '') }}</textarea>
            </div>

            {{-- Pilih Gambar dari Media --}}
            <div x-data="galeriMediaPicker()">
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Pilih Gambar dari Media</label>

                {{-- Counter + Search --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-4">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-check-circle text-primary mr-1"></i>
                        <span x-text="selectedCount"></span> gambar dipilih
                    </p>
                    <div class="relative w-full sm:w-72">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-search"></i></span>
                        <input type="text" x-model="search" placeholder="Cari judul / nama file..."
                               class="w-full border border-gray-300 p-3 pl-10 text-sm focus:border-primary focus:outline-none transition no-round">
                    </div>
                </div>

                @if ($media->count() > 0)
                    {{-- Image Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 max-h-[28rem] overflow-y-auto border border-gray-200 p-3 bg-gray-50">
                        @foreach ($media as $m)
                            <div x-show="matchSearch('{{ addslashes($m->judul) }}', '{{ addslashes($m->file_name) }}')"
                                 @click="toggle({{ $m->id }})"
                                 :class="isSelected({{ $m->id }}) ? 'ring-2 ring-primary ring-offset-1 bg-primary/5' : 'hover:ring-2 hover:ring-gray-300'"
                                 class="relative cursor-pointer border border-gray-200 bg-white group transition">
                                <img src="{{ asset('storage/' . $m->file_path) }}" alt="{{ $m->judul }}"
                                     class="w-full h-28 object-cover">
                                <div class="p-2">
                                    <p class="text-xs font-semibold text-gray-700 truncate">{{ $m->judul }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $m->file_name }}</p>
                                </div>
                                {{-- Checkbox indicator --}}
                                <div :class="isSelected({{ $m->id }}) ? 'bg-primary' : 'bg-white border-2 border-gray-300'"
                                     class="absolute top-2 right-2 w-6 h-6 flex items-center justify-center no-round transition">
                                    <i x-show="isSelected({{ $m->id }})" class="fas fa-check text-white text-xs"></i>
                                </div>
                                {{-- Hidden checkbox --}}
                                <input type="checkbox" name="media_ids[]" value="{{ $m->id }}"
                                       :checked="isSelected({{ $m->id }})" class="hidden">
                            </div>
                        @endforeach
                    </div>

                    {{-- No search results --}}
                    <div x-show="search && !hasVisibleItems()" class="text-center py-8 text-gray-400 border border-gray-200 bg-gray-50 mt-3">
                        <i class="fas fa-search text-2xl mb-2"></i>
                        <p class="text-sm">Tidak ditemukan gambar dengan kata kunci tersebut.</p>
                    </div>
                @else
                    <div class="bg-gray-50 border border-gray-300 p-8 text-center text-gray-400">
                        <i class="fas fa-images text-3xl mb-2 block"></i>
                        Belum ada media foto. <a href="{{ route('penulis.media.create') }}" class="text-primary underline">Upload media</a> terlebih dahulu.
                    </div>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round">
                    <i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                </button>
                <a href="{{ route('penulis.galeri.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
function galeriMediaPicker() {
    return {
        selected: @json(array_map('intval', $selectedIds)),
        search: '',
        mediaData: @json($media->map(fn ($m) => ['id' => $m->id, 'judul' => $m->judul, 'file_name' => $m->file_name])),

        get selectedCount() {
            return this.selected.length;
        },

        isSelected(id) {
            return this.selected.includes(id);
        },

        toggle(id) {
            if (this.isSelected(id)) {
                this.selected = this.selected.filter(i => i !== id);
            } else {
                this.selected.push(id);
            }
        },

        matchSearch(judul, fileName) {
            if (!this.search) return true;
            const q = this.search.toLowerCase();
            return judul.toLowerCase().includes(q) || fileName.toLowerCase().includes(q);
        },

        hasVisibleItems() {
            if (!this.search) return true;
            const q = this.search.toLowerCase();
            return this.mediaData.some(m => m.judul.toLowerCase().includes(q) || m.file_name.toLowerCase().includes(q));
        }
    }
}
</script>
@endpush
