@extends('layouts.dashboard')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')

@section('content')
    <div class="bg-white shadow-sm p-6">
        @php $prefix = session('user.role') === 'admin_master' ? 'admin' : 'penulis'; @endphp
        <form action="{{ route("{$prefix}.profil.update") }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @method('PUT')

            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan nama lengkap">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan email">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Password Baru <span class="normal-case font-normal text-gray-400">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan password baru">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Contoh: 08123456789">
                @error('nomor_hp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Keterangan Singkat</label>
                <input type="text" name="keterangan_singkat" value="{{ old('keterangan_singkat', $user->keterangan_singkat) }}" class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Contoh: Staf Humas" maxlength="255">
                @error('keterangan_singkat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Role</label>
                <input type="text" value="{{ $user->role === 'admin_master' ? 'Admin Master' : ucfirst($user->role) }}" disabled class="w-full border border-gray-200 bg-gray-100 p-4 text-base text-gray-500 no-round">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-primary-700 transition uppercase text-base tracking-wide no-round">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route("{$prefix}.dashboard") }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-base tracking-wide no-round">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
