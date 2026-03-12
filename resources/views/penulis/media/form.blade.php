@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Media' : 'Upload Media')
@section('page-title', $editMode ? 'Edit Media' : 'Upload Media')
@section('content')
    @php $currentTipe = old('tipe', $editMode ? $media->tipe : ''); @endphp
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.media.update', $media->id) : route('penulis.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl" x-data="{ tipe: '{{ $currentTipe }}' }">
            @csrf
            @if ($editMode) @method('PUT') @endif

            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul / Keterangan</label>
                <input type="text" name="judul" value="{{ old('judul', $editMode ? $media->judul : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Judul atau keterangan media">
            </div>

            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Tipe Media</label>
                <select name="tipe" x-model="tipe" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                    <option value="">Pilih Tipe</option>
                    <option value="foto">Foto</option>
                    <option value="video">Video</option>
                </select>
            </div>

            {{-- Foto: File Upload --}}
            <div x-show="tipe === 'foto'" x-cloak>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">File Gambar {{ $editMode ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="file" name="file" accept="image/*" {{ $editMode ? '' : '' }} class="w-full border border-gray-300 p-3 text-base no-round">
                @if ($editMode && $media->tipe === 'foto')
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 mb-2">File saat ini: {{ $media->file_name }} ({{ $media->formatted_size }})</p>
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->judul }}" class="max-h-48 border border-gray-200">
                    </div>
                @endif
            </div>

            {{-- Video: YouTube URL --}}
            <div x-show="tipe === 'video'" x-cloak>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Link YouTube</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', ($editMode && $media->tipe === 'video') ? $media->file_path : '') }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="https://www.youtube.com/watch?v=...">
                <p class="text-sm text-gray-400 mt-1">Masukkan link video YouTube (contoh: https://www.youtube.com/watch?v=xxxxx)</p>
                @if ($editMode && $media->tipe === 'video' && $media->file_name)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 mb-2">Preview video saat ini:</p>
                        <div class="aspect-video max-w-md border border-gray-200">
                            <iframe src="https://www.youtube.com/embed/{{ $media->file_name }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">URL: {{ $media->file_path }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 text-base text-blue-700">
                <i class="fas fa-info-circle mr-2"></i> Media yang diupload akan tersedia untuk digunakan di berita dan galeri.
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round"><i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Upload' }}</button>
                <a href="{{ route('penulis.media.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection
