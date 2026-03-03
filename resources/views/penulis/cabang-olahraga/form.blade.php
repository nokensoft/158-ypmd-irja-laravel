@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Cabang Olahraga' : 'Tambah Cabang Olahraga')
@section('page-title', $editMode ? 'Edit Cabor' : 'Tambah Cabor')
@section('content')
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.cabang-olahraga.update', $cabor->id) : route('penulis.cabang-olahraga.store') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @if ($editMode) @method('PUT') @endif
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Nama Cabor</label><input type="text" name="nama" value="{{ old('nama', $editMode ? $cabor->nama : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Nama cabang olahraga"></div>
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Icon (Font Awesome)</label><input type="text" name="icon" value="{{ old('icon', $editMode ? $cabor->icon : '') }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="cth: fa-running"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Jumlah Atlet</label><input type="number" name="jumlah_atlet" value="{{ old('jumlah_atlet', $editMode ? $cabor->jumlah_atlet : 0) }}" class="w-full border border-gray-300 p-4 text-base no-round" placeholder="0"></div>
                <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Jumlah Medali</label><input type="number" name="jumlah_medali" value="{{ old('jumlah_medali', $editMode ? $cabor->jumlah_medali : 0) }}" class="w-full border border-gray-300 p-4 text-base no-round" placeholder="0"></div>
            </div>
            <div><label class="text-base font-bold uppercase text-gray-500 block mb-2">Deskripsi</label><textarea name="deskripsi" rows="4" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round resize-none" placeholder="Deskripsi cabor">{{ old('deskripsi', $editMode ? $cabor->deskripsi : '') }}</textarea></div>
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round"><i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('penulis.cabang-olahraga.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection
