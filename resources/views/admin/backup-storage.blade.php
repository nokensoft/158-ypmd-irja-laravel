@extends('layouts.dashboard')
@section('title', 'Backup Storage')
@section('page-title', 'Backup Storage')

@section('content')
    {{-- Buat Backup --}}
    <div class="bg-white shadow-sm p-6 mb-6">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-folder-open mr-2 text-primary"></i> Buat Backup Storage Baru
        </h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <p class="text-base text-gray-500">Kompres seluruh folder storage (media, gambar, dokumen) ke dalam file ZIP.</p>
                <p class="text-sm text-gray-400 mt-1">Format: <code class="bg-gray-100 px-2 py-0.5 text-xs font-mono">backup_storage_2026-03-13_024554.zip</code></p>
            </div>
            <form action="{{ route('admin.backup-storage.create') }}" method="POST">
                @csrf
                <button type="submit" class="bg-primary text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap">
                    <i class="fas fa-file-archive mr-2"></i> Buat Backup ZIP
                </button>
            </form>
        </div>
    </div>

    {{-- Restore Storage --}}
    <div class="bg-white shadow-sm p-6 mb-6" x-data="{ showRestore: false }">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-upload mr-2 text-primary"></i> Restore Storage
        </h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-4">
            <p class="text-base text-gray-500">Upload file ZIP backup untuk me-restore folder storage.</p>
            <button type="button" @click="showRestore = !showRestore" class="bg-primary text-white px-6 py-3 font-bold text-base hover:bg-primary-700 transition no-round whitespace-nowrap">
                <i class="fas fa-upload mr-2"></i> Upload File ZIP
            </button>
        </div>
        <div x-show="showRestore" x-transition class="mt-4">
            <form action="{{ route('admin.backup-storage.restore') }}" method="POST" enctype="multipart/form-data"
                  x-data="{ confirmed: false }"
                  @submit.prevent="if (confirmed) { $el.submit() } else { confirmed = true }">
                @csrf
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div class="flex-1 w-full">
                        <label class="text-base font-bold uppercase text-gray-500 block mb-2">File ZIP (.zip)</label>
                        <input type="file" name="zip_file" accept=".zip" required
                               class="w-full border border-gray-300 p-3 text-base no-round cursor-pointer
                                      file:mr-4 file:py-2 file:px-4 file:border-0 file:font-bold file:text-sm
                                      file:bg-primary file:text-white file:cursor-pointer hover:file:bg-red-700 file:transition">
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap"
                            x-text="confirmed ? 'Klik Sekali Lagi untuk Konfirmasi' : 'Restore Sekarang'">
                    </button>
                </div>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-base text-red-700 mt-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Perhatian:</strong> Proses restore akan menimpa file yang sudah ada di folder storage jika memiliki nama yang sama.
                </div>
            </form>
        </div>
    </div>

    {{-- Buat Storage Link --}}
    <div class="bg-white shadow-sm p-6 mb-6">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-link mr-2 text-primary"></i> Storage Link (Symlink)
        </h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <p class="text-base text-gray-500">Buat symlink <code class="bg-gray-100 px-2 py-0.5 text-xs font-mono">public/storage</code> → <code class="bg-gray-100 px-2 py-0.5 text-xs font-mono">storage/app/public</code> agar file media dapat diakses di website.</p>
                <p class="text-sm text-gray-400 mt-1">Jalankan ini jika gambar/file tidak tampil setelah restore atau deploy ulang.</p>
            </div>
            <form action="{{ route('admin.backup-storage.storage-link') }}" method="POST">
                @csrf
                <button type="submit" class="bg-primary text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap">
                    <i class="fas fa-link mr-2"></i> Buat Storage Link
                </button>
            </form>
        </div>
    </div>

    {{-- Riwayat Backup --}}
    <div class="bg-white shadow-sm p-6">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-history mr-2 text-primary"></i> Riwayat Backup Storage ({{ count($backups) }})
        </h3>

        @if (count($backups) > 0)
            <div class="space-y-0">
                @foreach ($backups as $backup)
                    <div class="flex items-center justify-between py-4 border-b border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gray-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-file-archive text-primary text-xl"></i>
                            </div>
                            <div>
                                <p class="text-base font-bold">{{ $backup['filename'] }}</p>
                                <p class="text-sm text-gray-400">{{ $backup['formatted_size'] }} &middot; {{ $backup['date'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.backup-storage.download', $backup['filename']) }}" class="text-gray-500 hover:text-primary transition p-2" title="Unduh">
                                <i class="fas fa-download"></i>
                            </a>
                            <button type="button" @click="$dispatch('confirm-action', { title: 'Hapus Backup', message: 'Yakin ingin menghapus file backup {{ $backup['filename'] }}?', action: '{{ route('admin.backup-storage.destroy', $backup['filename']) }}', method: 'DELETE' })"
                                    class="text-gray-500 hover:text-red-600 transition p-2" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                <p class="text-base">Belum ada file backup storage. Klik "Buat Backup ZIP" untuk memulai.</p>
            </div>
        @endif
    </div>
@endsection
