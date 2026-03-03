@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Kategori' : 'Tambah Kategori')
@section('page-title', $editMode ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.kategori-berita.update', $kategoriBerita->id) : route('penulis.kategori-berita.store') }}" method="POST" class="space-y-6 max-w-xl">
            @csrf
            @if ($editMode) @method('PUT') @endif
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Nama Kategori</label><input type="text" name="nama" value="{{ old('nama', $editMode ? $kategoriBerita->nama : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Nama kategori"></div>
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round"><i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('penulis.kategori-berita.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection
