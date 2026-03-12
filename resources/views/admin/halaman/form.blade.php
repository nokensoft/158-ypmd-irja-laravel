@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Halaman' : 'Tambah Halaman')
@section('page-title', $editMode ? 'Edit Halaman' : 'Tambah Halaman')
@section('content')
    {{-- CodeMirror Local --}}
    <link rel="stylesheet" href="{{ asset('vendor/codemirror/codemirror.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/codemirror/theme/dracula.min.css') }}">
    <style>
        .CodeMirror { height: 500px; font-size: 14px; border: 1px solid #d1d5db; }
    </style>

    <form action="{{ $editMode ? route('admin.halaman.update', $halaman->id) : route('admin.halaman.store') }}"
          method="POST" class="space-y-6">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Judul --}}
                <div class="bg-white shadow-sm p-6">
                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul Halaman <span class="text-red-500">*</span></label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $editMode ? $halaman->judul : '') }}"
                           required
                           class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round"
                           placeholder="Contoh: Sejarah Singkat YPMD IRJA">
                    @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Konten Editor --}}
                <div class="bg-white shadow-sm p-6">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-base font-bold uppercase text-gray-500">Konten Halaman (HTML)</label>
                        <div class="flex items-center gap-2">
                            <label class="text-xs font-bold uppercase text-gray-400">Sisipkan Template:</label>
                            <select id="templatePicker" onchange="insertTemplate(this.value); this.value='';"
                                    class="border border-gray-300 text-sm p-2 focus:border-primary focus:outline-none no-round">
                                <option value="">— Pilih Template —</option>
                                <option value="dua-kolom">2 Kolom (Profil)</option>
                                <option value="kepemimpinan">Box Kepemimpinan 3 Kolom</option>
                                <option value="bidang-kerja">Box Bidang Kerja</option>
                                <option value="timeline">Timeline Tonggak Sejarah</option>
                                <option value="cta">CTA — Ingin Tahu Lebih Lanjut</option>
                            </select>
                        </div>
                    </div>
                    <textarea name="konten" id="kontenEditor">{{ old('konten', $editMode ? $halaman->konten : '') }}</textarea>
                    @error('konten') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish --}}
                <div class="bg-white shadow-sm p-6 space-y-4">
                    <h3 class="text-base font-bold uppercase text-gray-500 pb-3 border-b border-gray-100">Pengaturan</h3>

                    <div>
                        <label class="text-xs font-bold uppercase text-gray-400 block mb-1">Slug (URL)</label>
                        <input type="text" name="slug"
                               value="{{ old('slug', $editMode ? $halaman->slug : '') }}"
                               class="w-full border border-gray-300 p-3 text-sm focus:border-primary focus:outline-none transition no-round"
                               placeholder="otomatis dari judul">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan untuk generate otomatis.</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase text-gray-400 block mb-1">Keterangan Singkat</label>
                        <input type="text" name="keterangan"
                               value="{{ old('keterangan', $editMode ? $halaman->keterangan : '') }}"
                               class="w-full border border-gray-300 p-3 text-sm focus:border-primary focus:outline-none transition no-round"
                               placeholder="Deskripsi singkat untuk breadcrumb">
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase text-gray-400 block mb-1">Urutan</label>
                        <input type="number" name="urutan" min="0"
                               value="{{ old('urutan', $editMode ? $halaman->urutan : 0) }}"
                               class="w-full border border-gray-300 p-3 text-sm focus:border-primary focus:outline-none transition no-round">
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="w-5 h-5"
                                   {{ old('is_active', $editMode ? $halaman->is_active : true) ? 'checked' : '' }}>
                            <span class="text-sm font-bold uppercase text-gray-500">Halaman Aktif</span>
                        </label>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 bg-primary text-white py-3 font-bold hover:bg-red-700 transition uppercase text-sm no-round">
                            <i class="fas fa-save mr-2"></i>{{ $editMode ? 'Perbarui' : 'Simpan' }}
                        </button>
                        <a href="{{ route('admin.halaman.index') }}"
                           class="bg-gray-200 text-gray-700 px-6 py-3 font-bold hover:bg-gray-300 transition uppercase text-sm no-round">
                            Batal
                        </a>
                    </div>
                </div>

                {{-- Template Reference --}}
                <div class="bg-white shadow-sm p-6">
                    <h3 class="text-base font-bold uppercase text-gray-500 pb-3 border-b border-gray-100 mb-3">Panduan Template</h3>
                    <ul class="text-xs text-gray-500 space-y-2">
                        <li><strong class="text-gray-700">2 Kolom:</strong> Layout profil dengan gambar kiri, teks kanan</li>
                        <li><strong class="text-gray-700">Kepemimpinan:</strong> Grid 3 kolom card foto + nama + jabatan</li>
                        <li><strong class="text-gray-700">Bidang Kerja:</strong> Card icon + judul + deskripsi program</li>
                        <li><strong class="text-gray-700">Timeline:</strong> Garis waktu vertikal dengan tonggak sejarah</li>
                        <li><strong class="text-gray-700">CTA:</strong> Section ajakan bertindak dengan tombol</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('vendor/codemirror/codemirror.min.js') }}"></script>
    <script src="{{ asset('vendor/codemirror/mode/xml/xml.min.js') }}"></script>
    <script src="{{ asset('vendor/codemirror/mode/htmlmixed/htmlmixed.min.js') }}"></script>
    <script src="{{ asset('vendor/codemirror/mode/css/css.min.js') }}"></script>
    <script src="{{ asset('vendor/codemirror/mode/javascript/javascript.min.js') }}"></script>
    <script>
    const editor = CodeMirror.fromTextArea(document.getElementById('kontenEditor'), {
        mode: 'htmlmixed',
        theme: 'dracula',
        lineNumbers: true,
        lineWrapping: true,
        indentUnit: 4,
        tabSize: 4,
        autoCloseTags: true,
    });

    const templates = {
        'dua-kolom': `<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-start">
            <div class="fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-building mr-2"></i>Label</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Judul Bagian</h2>
                <p class="text-neutral-600 leading-relaxed mb-4">Paragraf pertama konten...</p>
                <p class="text-neutral-600 leading-relaxed mb-6">Paragraf kedua konten...</p>
                <img src="" alt="Gambar" class="w-full rounded-lg shadow-card"/>
            </div>
            <div class="space-y-8">
                <div class="fade-in">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-eye text-primary-500"></i></div>
                        <h3 class="font-display font-bold text-neutral-900">Sub Judul</h3>
                    </div>
                    <p class="text-neutral-600 leading-relaxed pl-11">Deskripsi konten...</p>
                </div>
                <div class="fade-in">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-bullseye text-primary-500"></i></div>
                        <h3 class="font-display font-bold text-neutral-900">Sub Judul Lain</h3>
                    </div>
                    <ul class="text-neutral-600 space-y-2 pl-11">
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Item pertama</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Item kedua</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>`,

        'kepemimpinan': `<section class="py-20 bg-neutral-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-10 fade-in">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-user-tie mr-2"></i>Kepemimpinan</p>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Judul Kepemimpinan</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Ulangi card berikut untuk setiap orang -->
            <div class="bg-white border border-neutral-100 fade-in">
                <div class="h-48 bg-neutral-50 flex items-center justify-center">
                    <img src="" alt="Nama" class="w-28 h-28 rounded-full object-cover border-4 border-white shadow">
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-6 rounded-full bg-primary-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                        <span class="text-xs text-primary-500 font-semibold uppercase tracking-wider">Label Jabatan</span>
                    </div>
                    <h3 class="font-display font-bold text-neutral-900 text-base mt-2 mb-1">Nama Lengkap</h3>
                    <p class="text-sm text-neutral-500"><i class="fa-regular fa-calendar mr-1.5 text-neutral-300"></i>Periode</p>
                </div>
            </div>
            <!-- Akhir card -->
        </div>
    </div>
</section>`,

        'bidang-kerja': `<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Ulangi card berikut untuk setiap bidang -->
            <div class="shadow-card border border-neutral-100 fade-in">
                <div class="h-1.5 bg-primary-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-circle-info text-primary-500 text-xl"></i>
                    </div>
                    <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Nama Bidang</h2>
                    <ul class="space-y-3">
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-microscope text-primary-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Sub Program</p>
                                <p class="text-neutral-500 text-sm">Deskripsi program...</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Akhir card -->
        </div>
    </div>
</section>`,

        'timeline': `<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h3 class="text-xl font-display font-bold text-neutral-900 mb-8">Tonggak Sejarah</h3>
        <div class="relative border-l-2 border-primary-200 pl-8 space-y-8">
            <!-- Ulangi item berikut untuk setiap tonggak -->
            <div class="relative fade-in">
                <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">1982</span>
                <h4 class="font-display font-bold text-neutral-900">Judul Peristiwa</h4>
                <p class="text-neutral-500 text-sm mt-1">Deskripsi peristiwa...</p>
            </div>
            <!-- Akhir item -->
        </div>
    </div>
</section>`,

        'cta': `<section class="py-16 bg-neutral-50 border-t border-neutral-100">
    <div class="max-w-6xl mx-auto px-6 text-center fade-in">
        <h2 class="text-xl md:text-2xl font-display font-bold text-neutral-900 mb-3">Ingin Tahu Lebih Lanjut?</h2>
        <p class="text-neutral-500 max-w-lg mx-auto mb-6">Deskripsi ajakan bertindak...</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                <i class="fa-solid fa-list-check mr-2"></i>Tombol Utama
            </a>
            <a href="#" class="border border-neutral-300 text-neutral-700 px-8 py-3 text-sm font-semibold hover:border-primary-400 hover:text-primary-600 transition-colors">
                <i class="fa-solid fa-envelope mr-2"></i>Tombol Sekunder
            </a>
        </div>
    </div>
</section>`,
    };

    function insertTemplate(key) {
        if (!key || !templates[key]) return;
        const cursor = editor.getCursor();
        const currentVal = editor.getValue();
        const separator = currentVal.trim() ? '\n\n' : '';
        editor.replaceRange(separator + templates[key], cursor);
        editor.focus();
    }
    </script>
@endsection
