@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Kegiatan' : 'Tambah Kegiatan')
@section('page-title', $editMode ? 'Edit Kegiatan' : 'Tambah Kegiatan')
@section('content')
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.kegiatan.update', $kegiatan->id) : route('penulis.kegiatan.store') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @if ($editMode) @method('PUT') @endif
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Judul Kegiatan</label><input type="text" name="judul" value="{{ old('judul', $editMode ? $kegiatan->judul : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Judul kegiatan"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Tanggal Mulai</label><input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $editMode ? $kegiatan->tanggal_mulai->format('Y-m-d') : '') }}" required class="w-full border border-gray-300 p-4 text-base no-round"></div>
                <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Tanggal Selesai</label><input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $editMode && $kegiatan->tanggal_selesai ? $kegiatan->tanggal_selesai->format('Y-m-d') : '') }}" class="w-full border border-gray-300 p-4 text-base no-round"></div>
            </div>
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Lokasi</label><input type="text" name="lokasi" value="{{ old('lokasi', $editMode ? $kegiatan->lokasi : '') }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Lokasi kegiatan"></div>
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Deskripsi</label><textarea name="deskripsi" rows="5" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none" placeholder="Deskripsi kegiatan">{{ old('deskripsi', $editMode ? $kegiatan->deskripsi : '') }}</textarea></div>
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round"><i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('penulis.kegiatan.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection
