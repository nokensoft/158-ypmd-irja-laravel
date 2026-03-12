@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Edisi KDK' : 'Tambah Edisi KDK')
@section('page-title', $editMode ? 'Edit Edisi KDK' : 'Tambah Edisi KDK')
@section('content')
    <div class="max-w-2xl" x-data="kdkMediaPicker()">
        <div class="bg-white shadow-sm p-6">
            <form action="{{ $editMode ? route('penulis.kdk.update', $kdk->id) : route('penulis.kdk.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if ($editMode) @method('PUT') @endif

                {{-- Nomor Edisi --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nomor Edisi <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_edisi"
                           value="{{ old('nomor_edisi', $editMode ? $kdk->nomor_edisi : '') }}"
                           required maxlength="20"
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Contoh: 6, VII, 2024-01">
                    @error('nomor_edisi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Judul --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $editMode ? $kdk->judul : '') }}"
                           required
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Contoh: Kabar Dari Kampung — Edisi 6">
                    @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal Terbit --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Tanggal Terbit</label>
                    <input type="date" name="tanggal_terbit"
                           value="{{ old('tanggal_terbit', ($editMode && $kdk->tanggal_terbit) ? $kdk->tanggal_terbit->format('Y-m-d') : '') }}"
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round">
                    @error('tanggal_terbit') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none"
                              placeholder="Deskripsi singkat isi buletin ini (opsional)">{{ old('deskripsi', $editMode ? $kdk->deskripsi : '') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Cover Image (Media Picker) --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Cover Buletin</label>
                    <input type="hidden" name="media_id" :value="selectedMediaId">

                    {{-- Preview (Portrait / Book Cover) --}}
                    <div x-show="selectedMediaId" class="mb-3">
                        <div class="relative inline-block">
                            <img :src="selectedMediaUrl" class="w-32 h-44 object-cover border border-gray-200 shadow-sm" alt="Cover">
                            <button type="button" @click="clearMedia()"
                                    class="absolute top-1 right-1 bg-red-600 text-white w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700 transition no-round">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 truncate" x-text="selectedMediaJudul"></p>
                    </div>

                    <button type="button" @click="openModal()"
                            class="bg-gray-100 text-gray-700 px-6 py-3 font-bold text-sm hover:bg-gray-200 transition no-round">
                        <i class="fas fa-image mr-2"></i>Pilih dari Media
                    </button>
                    <p class="text-xs text-gray-400 mt-1">Gambar cover untuk buletin KDK (opsional).</p>
                    @error('media_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- File PDF --}}
                <div>
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">File PDF Buletin</label>
                    @if ($editMode && $kdk->file_pdf)
                        <div class="mb-3 flex items-center gap-4 p-3 bg-gray-50 border border-gray-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">{{ basename($kdk->file_pdf) }}</p>
                                <a href="{{ asset('storage/' . $kdk->file_pdf) }}" target="_blank"
                                   class="text-xs text-primary hover:underline">Lihat PDF saat ini</a>
                            </div>
                            <label class="flex items-center gap-2 text-sm text-red-600 cursor-pointer">
                                <input type="checkbox" name="hapus_pdf" value="1" class="w-4 h-4">
                                Hapus PDF
                            </label>
                        </div>
                    @endif
                    <input type="file" name="file_pdf" accept="application/pdf"
                           class="w-full border border-gray-300 p-3 text-base no-round">
                    <p class="text-xs text-gray-400 mt-1">Format: PDF. Maksimal 20 MB. Upload baru akan menggantikan yang lama.</p>
                    @error('file_pdf') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round">
                        <i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('penulis.kdk.index') }}"
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
                    <h3 class="font-bold text-base uppercase text-gray-700">Pilih Cover dari Media</h3>
                    <button type="button" @click="modalOpen = false" class="text-gray-400 hover:text-gray-700 text-xl"><i class="fas fa-times"></i></button>
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
                        Belum ada media foto. Upload melalui menu Media terlebih dahulu.
                    </p>
                </div>
                <div class="px-6 py-3 border-t border-gray-200 text-right">
                    <button type="button" @click="modalOpen = false" class="bg-primary text-white px-6 py-2 font-bold text-sm no-round hover:bg-red-700 transition">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @php
        $initialMedia = $editMode && ($kdk->media ?? null) ? [
            'id' => $kdk->media->id,
            'judul' => $kdk->media->judul,
            'file_path' => asset('storage/' . $kdk->media->file_path),
        ] : null;
    @endphp
    <script>
    function kdkMediaPicker() {
        const initial = @json($initialMedia);

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
