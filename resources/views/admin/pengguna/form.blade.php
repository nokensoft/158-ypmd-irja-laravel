@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('page-title', $editMode ? 'Edit Pengguna' : 'Tambah Pengguna')

@section('content')
    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('admin.pengguna.update', $pengguna->id) : route('admin.pengguna.store') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @if ($editMode) @method('PUT') @endif

            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $editMode ? $pengguna->name : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan nama lengkap">
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $editMode ? $pengguna->email : '') }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan email">
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Password {{ $editMode ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="password" name="password" {{ $editMode ? '' : 'required' }} class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan password">
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $editMode ? $pengguna->nomor_hp : '') }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Contoh: 08123456789">
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Keterangan Singkat</label>
                <input type="text" name="keterangan_singkat" value="{{ old('keterangan_singkat', $editMode ? $pengguna->keterangan_singkat : '') }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Contoh: Staf Humas" maxlength="255">
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Role</label>
                <select name="role" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                    <option value="">Pilih Role</option>
                    <option value="admin_master" {{ old('role', $editMode ? $pengguna->role : '') === 'admin_master' ? 'selected' : '' }}>Admin Master</option>
                    <option value="penulis" {{ old('role', $editMode ? $pengguna->role : '') === 'penulis' ? 'selected' : '' }}>Penulis</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $editMode ? $pengguna->is_active : true) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 peer-checked:bg-green-500 rounded-full peer peer-focus:ring-2 peer-focus:ring-green-300 transition-all after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                </label>
                <span class="text-base font-bold uppercase text-gray-500">Status Aktif</span>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide no-round">
                    <i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.pengguna.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
