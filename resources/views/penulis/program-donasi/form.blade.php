@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Program Donasi' : 'Tambah Program Donasi')
@section('page-title', $editMode ? 'Edit Program Donasi' : 'Tambah Program Donasi')
@section('content')
    <div class="max-w-2xl" x-data="mediaPicker()">
        <div class="bg-white shadow-sm p-6">
            <form action="{{ $editMode ? route('penulis.program-donasi.update', $program->id) : route('penulis.program-donasi.store') }}"
                  method="POST" class="space-y-6">
                @csrf
                @if ($editMode) @method('PUT') @endif

                {{-- Judul --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul Program <span class="text-red-500">*</span></label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $editMode ? $program->judul : '') }}"
                           required
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Contoh: Promosi Usaha UMKM Lokal">
                    @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                              class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none"
                              placeholder="Deskripsi lengkap program donasi...">{{ old('deskripsi', $editMode ? $program->deskripsi : '') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Cover Image (Media Picker) --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Cover Image</label>
                    <input type="hidden" name="media_id" :value="selectedMediaId">

                    {{-- Preview --}}
                    <div x-show="selectedMediaId" class="mb-3 flex items-center gap-4 p-3 bg-gray-50 border border-gray-200">
                        <img :src="selectedMediaUrl" class="w-20 h-16 object-cover" alt="Cover">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-700 truncate" x-text="selectedMediaJudul"></p>
                        </div>
                        <button type="button" @click="clearMedia()" class="text-red-500 hover:text-red-700 text-sm font-bold">
                            <i class="fas fa-times"></i> Hapus
                        </button>
                    </div>

                    <button type="button" @click="openModal()"
                            class="bg-gray-100 text-gray-700 px-6 py-3 font-bold text-sm hover:bg-gray-200 transition no-round">
                        <i class="fas fa-image mr-2"></i>Pilih dari Media
                    </button>
                    @error('media_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Target Nominal --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Target Nominal (Rp)</label>
                    <input type="number" name="target_nominal" min="0"
                           value="{{ old('target_nominal', $editMode ? $program->target_nominal : '') }}"
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Kosongkan jika tanpa target">
                    <p class="text-xs text-gray-400 mt-1">Jika dikosongkan, progress bar tidak akan ditampilkan.</p>
                    @error('target_nominal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status Aktif --}}
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                               class="w-5 h-5"
                               {{ old('is_active', $editMode ? $program->is_active : true) ? 'checked' : '' }}>
                        <span class="text-base font-bold uppercase text-gray-500">Program Aktif</span>
                    </label>
                    <p class="text-xs text-gray-400 mt-1">Program yang tidak aktif tidak ditampilkan di halaman donasi publik.</p>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round">
                        <i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('penulis.program-donasi.index') }}"
                       class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Media Picker Modal --}}
        <div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" @click.self="modalOpen = false" style="display:none">
            <div class="bg-white w-full max-w-3xl max-h-[80vh] flex flex-col shadow-xl">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="font-bold text-base uppercase text-gray-700">Pilih Media</h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-700 text-xl"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6 overflow-y-auto flex-1">
                    <div x-show="loading" class="text-center py-8 text-gray-400">
                        <i class="fas fa-spinner fa-spin text-2xl"></i>
                        <p class="mt-2 text-sm">Memuat media...</p>
                    </div>
                    <div x-show="!loading" class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                        <template x-for="m in mediaList" :key="m.id">
                            <div @click="selectMedia(m)"
                                 :class="selectedMediaId == m.id ? 'ring-2 ring-primary' : 'hover:ring-2 hover:ring-gray-300'"
                                 class="cursor-pointer border border-gray-200 overflow-hidden transition">
                                <img :src="m.file_path" :alt="m.judul" class="w-full h-24 object-cover">
                                <p class="text-xs text-gray-600 p-2 truncate" x-text="m.judul"></p>
                            </div>
                        </template>
                    </div>
                    <p x-show="!loading && mediaList.length === 0" class="text-center text-gray-400 py-8 text-sm">
                        Belum ada media foto.
                    </p>
                </div>
                <div class="px-6 py-3 border-t border-gray-200 text-right">
                    <button @click="modalOpen = false" class="bg-primary text-white px-6 py-2 font-bold text-sm no-round hover:bg-red-700 transition">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function mediaPicker() {
        const initial = @json($editMode && ($program->media ?? null) ? [
            'id' => $program->media->id,
            'judul' => $program->media->judul,
            'file_path' => asset('storage/' . $program->media->file_path),
        ] : null);

        return {
            modalOpen: false,
            loading: false,
            mediaList: [],
            selectedMediaId: initial ? initial.id : '',
            selectedMediaUrl: initial ? initial.file_path : '',
            selectedMediaJudul: initial ? initial.judul : '',

            openModal() {
                this.modalOpen = true;
                if (this.mediaList.length === 0) {
                    this.loading = true;
                    fetch('{{ route("penulis.media.json") }}')
                        .then(r => r.json())
                        .then(data => { this.mediaList = data; this.loading = false; })
                        .catch(() => { this.loading = false; });
                }
            },

            selectMedia(m) {
                this.selectedMediaId = m.id;
                this.selectedMediaUrl = m.file_path;
                this.selectedMediaJudul = m.judul;
                this.modalOpen = false;
            },

            clearMedia() {
                this.selectedMediaId = '';
                this.selectedMediaUrl = '';
                this.selectedMediaJudul = '';
            }
        };
    }
    </script>
@endsection
