@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Edisi KDK' : 'Tambah Edisi KDK')
@section('page-title', $editMode ? 'Edit Edisi KDK' : 'Tambah Edisi KDK')
@section('content')
    <div class="max-w-2xl">
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
    </div>
@endsection
