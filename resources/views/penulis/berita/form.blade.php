@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', $editMode ? 'Edit Berita' : 'Tambah Berita')
@section('content')
    <form action="{{ $editMode ? route('penulis.berita.update', $berita->id) : route('penulis.berita.store') }}" method="POST" enctype="multipart/form-data"
          x-data="beritaForm()">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- ========== LEFT COLUMN: Judul + Konten ========== --}}
            <div class="flex-1 space-y-6">

                {{-- Judul --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul', $editMode ? $berita->judul : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                           placeholder="Masukkan judul berita">
                    @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Ringkasan --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Ringkasan</label>
                    <textarea name="ringkasan" rows="3"
                              class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none"
                              placeholder="Ringkasan singkat berita (opsional)">{{ old('ringkasan', $editMode ? $berita->ringkasan : '') }}</textarea>
                    @error('ringkasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Konten --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Konten Berita</label>
                    <textarea name="konten" id="editor" required>{{ old('konten', $editMode ? $berita->konten : '') }}</textarea>
                    @error('konten') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Sumber Berita --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-3">Sumber Berita (Opsional)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-gray-500 block mb-1">Nama Sumber</label>
                            <input type="text" name="sumber_nama" value="{{ old('sumber_nama', $editMode ? $berita->sumber_nama : '') }}"
                                   class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition no-round"
                                   placeholder="Contoh: KlikTimur.com">
                        </div>
                        <div>
                            <label class="text-sm text-gray-500 block mb-1">Link Sumber</label>
                            <input type="url" name="sumber_link" value="{{ old('sumber_link', $editMode ? $berita->sumber_link : '') }}"
                                   class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition no-round"
                                   placeholder="https://...">
                        </div>
                    </div>
                    @error('sumber_nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    @error('sumber_link') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- ========== RIGHT COLUMN: Sidebar ========== --}}
            <div class="w-full lg:w-80 space-y-6">

                {{-- Status & Aksi --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Status</label>
                    <select name="status" class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                        <option value="draft" {{ old('status', $editMode ? $berita->status : 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="terbit" {{ old('status', $editMode ? $berita->status : '') === 'terbit' ? 'selected' : '' }}>Terbit</option>
                    </select>

                    <div class="flex gap-3 mt-4">
                        <button type="submit" class="flex-1 bg-primary text-white px-4 py-3 font-bold hover:bg-red-700 transition uppercase text-sm tracking-wide no-round text-center">
                            <i class="fas fa-save mr-1"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                        </button>
                        <a href="{{ route('penulis.berita.index') }}" class="bg-gray-200 text-gray-700 px-4 py-3 font-bold hover:bg-gray-300 transition uppercase text-sm tracking-wide no-round text-center">Batal</a>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Kategori</label>
                    <select name="kategori_berita_id" required class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_berita_id', $editMode ? $berita->kategori_berita_id : '') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_berita_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal Publikasi --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Tanggal Publikasi</label>
                    <input type="date" name="tanggal_terbit"
                           value="{{ old('tanggal_terbit', ($editMode && $berita->tanggal_terbit) ? $berita->tanggal_terbit->format('Y-m-d') : '') }}"
                           class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition no-round">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan untuk menggunakan tanggal saat ini</p>
                    @error('tanggal_terbit') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Gambar Berita --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Gambar Berita</label>
                    <input type="hidden" name="media_id" :value="selectedMediaId">

                    {{-- Preview --}}
                    <div class="mb-3">
                        <template x-if="previewUrl">
                            <div class="relative">
                                <img :src="previewUrl" class="w-full h-44 object-cover border border-gray-200" alt="Preview">
                                <button type="button" @click="clearMedia()" class="absolute top-2 right-2 bg-red-600 text-white w-7 h-7 flex items-center justify-center text-xs hover:bg-red-700 transition no-round">
                                    <i class="fas fa-times"></i>
                                </button>
                                <p class="text-xs text-gray-500 mt-1 truncate" x-text="selectedMediaName"></p>
                            </div>
                        </template>
                        <template x-if="!previewUrl">
                            <div class="w-full h-44 bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-image text-3xl mb-2"></i>
                                <span class="text-sm">Belum ada gambar</span>
                            </div>
                        </template>
                    </div>

                    {{-- Pilih dari Media --}}
                    <button type="button" @click="openMediaModal()"
                            class="w-full bg-dark text-white px-4 py-3 font-bold hover:bg-gray-800 transition uppercase text-sm tracking-wide no-round text-center">
                        <i class="fas fa-photo-video mr-1"></i> Pilih dari Media
                    </button>
                    @error('media_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>

        {{-- ========== MODAL: Pilih Gambar dari Media ========== --}}
        <div x-show="showModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/60" @click="showModal = false"></div>

            {{-- Modal Content --}}
            <div class="relative bg-white w-full max-w-3xl max-h-[85vh] flex flex-col shadow-xl no-round z-10">
                {{-- Header --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold uppercase text-dark">Pilih Gambar dari Media</h3>
                    <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-700 text-xl"><i class="fas fa-times"></i></button>
                </div>

                {{-- Tabs --}}
                <div class="flex border-b border-gray-200">
                    <button type="button" @click="modalTab = 'gallery'"
                            :class="modalTab === 'gallery' ? 'border-b-2 border-primary text-primary' : 'text-gray-500 hover:text-gray-700'"
                            class="px-6 py-3 font-bold text-sm uppercase tracking-wide transition">
                        <i class="fas fa-images mr-1"></i> Galeri Media
                    </button>
                    <button type="button" @click="modalTab = 'upload'"
                            :class="modalTab === 'upload' ? 'border-b-2 border-primary text-primary' : 'text-gray-500 hover:text-gray-700'"
                            class="px-6 py-3 font-bold text-sm uppercase tracking-wide transition">
                        <i class="fas fa-upload mr-1"></i> Upload Baru
                    </button>
                </div>

                {{-- Body --}}
                <div class="flex-1 overflow-y-auto p-6">

                    {{-- Tab: Gallery --}}
                    <div x-show="modalTab === 'gallery'">
                        <div x-show="loadingMedia" class="text-center py-10 text-gray-400">
                            <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                            <p>Memuat media...</p>
                        </div>
                        <div x-show="!loadingMedia && mediaList.length === 0" class="text-center py-10 text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2"></i>
                            <p>Belum ada media foto. Upload gambar terlebih dahulu.</p>
                        </div>
                        <div x-show="!loadingMedia && mediaList.length > 0" class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <template x-for="item in mediaList" :key="item.id">
                                <div @click="selectMedia(item)"
                                     :class="tempSelectedId === item.id ? 'ring-2 ring-primary ring-offset-1' : 'hover:ring-2 hover:ring-gray-300'"
                                     class="relative cursor-pointer border border-gray-200 group transition">
                                    <img :src="item.file_path" :alt="item.judul" class="w-full h-32 object-cover">
                                    <div class="p-2">
                                        <p class="text-xs font-semibold text-gray-700 truncate" x-text="item.judul"></p>
                                        <p class="text-xs text-gray-400" x-text="item.file_size"></p>
                                    </div>
                                    <div x-show="tempSelectedId === item.id" class="absolute top-2 right-2 bg-primary text-white w-6 h-6 flex items-center justify-center text-xs no-round">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Tab: Upload --}}
                    <div x-show="modalTab === 'upload'" class="space-y-4">
                        <div>
                            <label class="text-sm font-bold uppercase text-gray-500 block mb-1">Judul Gambar</label>
                            <input type="text" x-model="uploadJudul" class="w-full border border-gray-300 p-3 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Judul atau keterangan gambar">
                        </div>
                        <div>
                            <label class="text-sm font-bold uppercase text-gray-500 block mb-1">File Gambar</label>
                            <input type="file" @change="handleUploadFile($event)" accept="image/*" class="w-full border border-gray-300 p-3 text-base no-round" x-ref="uploadFileInput">
                        </div>
                        {{-- Upload Preview --}}
                        <template x-if="uploadPreviewUrl">
                            <img :src="uploadPreviewUrl" class="max-h-48 border border-gray-200" alt="Preview upload">
                        </template>
                        <button type="button" @click="doUpload()" :disabled="uploading"
                                class="bg-primary text-white px-6 py-3 font-bold hover:bg-red-700 transition uppercase text-sm tracking-wide no-round disabled:opacity-50">
                            <i class="fas fa-upload mr-1"></i>
                            <span x-text="uploading ? 'Mengupload...' : 'Upload & Pilih'"></span>
                        </button>
                        <template x-if="uploadError">
                            <p class="text-red-500 text-sm" x-text="uploadError"></p>
                        </template>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200" x-show="modalTab === 'gallery'">
                    <button type="button" @click="showModal = false" class="bg-gray-200 text-gray-700 px-6 py-3 font-bold hover:bg-gray-300 transition uppercase text-sm no-round">Batal</button>
                    <button type="button" @click="confirmSelection()" :disabled="!tempSelectedId"
                            class="bg-primary text-white px-6 py-3 font-bold hover:bg-red-700 transition uppercase text-sm no-round disabled:opacity-50">
                        <i class="fas fa-check mr-1"></i> Pilih Gambar
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="{{ asset('vendor/ckeditor5/ckeditor.js') }}"></script>
<script>
let editorInstance = null;

ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading', '|',
            'bold', 'italic', '|',
            'link', 'blockQuote', '|',
            'bulletedList', 'numberedList', '|',
            'outdent', 'indent', '|',
            'insertTable', 'mediaEmbed', '|',
            'undo', 'redo'
        ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
            ]
        },
        placeholder: 'Tulis konten berita lengkap...',
        language: 'id'
    })
    .then(editor => {
        editorInstance = editor;
        // Sync editor data to textarea on form submit
        editor.model.document.on('change:data', () => {
            document.querySelector('textarea[name="konten"]').value = editor.getData();
        });
    })
    .catch(error => console.error(error));

function beritaForm() {
    return {
        showModal: false,
        modalTab: 'gallery',
        mediaList: [],
        loadingMedia: false,
        selectedMediaId: '{{ old("media_id", $editMode ? ($berita->media_id ?? "") : "") }}',
        selectedMediaName: '',
        previewUrl: '',
        tempSelectedId: null,
        tempSelectedItem: null,

        // Upload
        uploadJudul: '',
        uploadFile: null,
        uploadPreviewUrl: '',
        uploading: false,
        uploadError: '',

        init() {
            @if($editMode && $berita->media_id && $berita->media)
                this.previewUrl = '{{ asset("storage/" . $berita->media->file_path) }}';
                this.selectedMediaName = '{{ $berita->media->judul }}';
            @endif
        },

        openMediaModal() {
            this.showModal = true;
            this.modalTab = 'gallery';
            this.tempSelectedId = this.selectedMediaId ? parseInt(this.selectedMediaId) : null;
            this.tempSelectedItem = null;
            this.resetUpload();
            this.fetchMedia();
        },

        async fetchMedia() {
            this.loadingMedia = true;
            try {
                const res = await fetch('{{ route("penulis.media.json") }}');
                this.mediaList = await res.json();
            } catch (e) {
                this.mediaList = [];
            }
            this.loadingMedia = false;
        },

        selectMedia(item) {
            this.tempSelectedId = item.id;
            this.tempSelectedItem = item;
        },

        confirmSelection() {
            if (this.tempSelectedItem) {
                this.selectedMediaId = this.tempSelectedItem.id;
                this.previewUrl = this.tempSelectedItem.file_path;
                this.selectedMediaName = this.tempSelectedItem.judul;
            }
            this.showModal = false;
        },

        clearMedia() {
            this.selectedMediaId = '';
            this.previewUrl = '';
            this.selectedMediaName = '';
        },

        // Upload handlers
        handleUploadFile(e) {
            const file = e.target.files[0];
            this.uploadFile = file;
            this.uploadError = '';
            if (file) {
                this.uploadPreviewUrl = URL.createObjectURL(file);
                if (!this.uploadJudul) {
                    this.uploadJudul = file.name.replace(/\.[^/.]+$/, '');
                }
            } else {
                this.uploadPreviewUrl = '';
            }
        },

        async doUpload() {
            this.uploadError = '';
            if (!this.uploadJudul.trim()) {
                this.uploadError = 'Judul gambar wajib diisi.';
                return;
            }
            if (!this.uploadFile) {
                this.uploadError = 'Pilih file gambar terlebih dahulu.';
                return;
            }
            this.uploading = true;
            try {
                const formData = new FormData();
                formData.append('judul', this.uploadJudul);
                formData.append('file', this.uploadFile);

                const res = await fetch('{{ route("penulis.media.upload-ajax") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (!res.ok) {
                    const err = await res.json();
                    this.uploadError = err.message || 'Gagal mengupload gambar.';
                    this.uploading = false;
                    return;
                }

                const media = await res.json();

                // Auto-select the uploaded media
                this.selectedMediaId = media.id;
                this.previewUrl = media.file_path;
                this.selectedMediaName = media.judul;
                this.showModal = false;
                this.resetUpload();
            } catch (e) {
                this.uploadError = 'Terjadi kesalahan saat mengupload.';
            }
            this.uploading = false;
        },

        resetUpload() {
            this.uploadJudul = '';
            this.uploadFile = null;
            this.uploadPreviewUrl = '';
            this.uploadError = '';
            if (this.$refs.uploadFileInput) {
                this.$refs.uploadFileInput.value = '';
            }
        }
    }
}
</script>
@endpush
