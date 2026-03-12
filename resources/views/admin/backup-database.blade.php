@extends('layouts.dashboard')
@section('title', 'Backup Database')
@section('page-title', 'Backup Database')

@section('content')
    {{-- Buat Backup --}}
    <div class="bg-white shadow-sm p-6 mb-6">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-database mr-2 text-primary"></i> Buat Backup Baru
        </h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p class="text-base text-gray-500">Generate file SQL backup dari seluruh database saat ini.</p>
            <form action="{{ route('admin.backup-database.create') }}" method="POST">
                @csrf
                <button type="submit" class="bg-primary text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Buat Backup SQL
                </button>
            </form>
        </div>
    </div>

    {{-- Restore Database --}}
    <div class="bg-white shadow-sm p-6 mb-6" x-data="{ showRestore: false }">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-upload mr-2 text-primary"></i> Restore Database
        </h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-4">
            <p class="text-base text-gray-500">Upload file SQL untuk me-restore database dari backup production.</p>
            <button type="button" @click="showRestore = !showRestore" class="bg-secondary text-white px-6 py-3 font-bold text-base hover:opacity-80 transition no-round whitespace-nowrap">
                <i class="fas fa-upload mr-2"></i> Upload File SQL
            </button>
        </div>
        <div x-show="showRestore" x-transition class="mt-4">
            <form action="{{ route('admin.backup-database.restore') }}" method="POST" enctype="multipart/form-data"
                  x-data="{ confirmed: false }"
                  @submit.prevent="if (confirmed) { $el.submit() } else { confirmed = true }">
                @csrf
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div class="flex-1 w-full">
                        <label class="text-base font-bold uppercase text-gray-500 block mb-2">File SQL (.sql)</label>
                        <input type="file" name="sql_file" accept=".sql,.txt" required
                               class="w-full border border-gray-300 p-3 text-base no-round cursor-pointer
                                      file:mr-4 file:py-2 file:px-4 file:border-0 file:font-bold file:text-sm
                                      file:bg-primary file:text-white file:cursor-pointer hover:file:bg-red-700 file:transition">
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 font-bold text-base hover:bg-red-700 transition no-round whitespace-nowrap"
                            x-text="confirmed ? 'Klik Sekali Lagi untuk Konfirmasi' : 'Restore Sekarang'">
                    </button>
                </div>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-base text-red-700 mt-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Perhatian:</strong> Proses restore akan menimpa data yang ada. Pastikan Anda sudah membuat backup terlebih dahulu.
                </div>
            </form>
        </div>
    </div>

    {{-- Riwayat Backup --}}
    <div class="bg-white shadow-sm p-6">
        <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
            <i class="fas fa-history mr-2 text-primary"></i> Riwayat Backup ({{ count($backups) }})
        </h3>

        @if (count($backups) > 0)
            <div class="space-y-0">
                @foreach ($backups as $backup)
                    <div class="flex items-center justify-between py-4 border-b border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gray-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-file-code text-primary text-xl"></i>
                            </div>
                            <div>
                                <p class="text-base font-bold">{{ $backup['filename'] }}</p>
                                <p class="text-sm text-gray-400">{{ $backup['formatted_size'] }} &middot; {{ $backup['date'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.backup-database.download', $backup['filename']) }}" class="text-gray-500 hover:text-primary transition p-2" title="Unduh">
                                <i class="fas fa-download"></i>
                            </a>
                            <button type="button" @click="$dispatch('confirm-action', { title: 'Hapus Backup', message: 'Yakin ingin menghapus file backup {{ $backup['filename'] }}?', action: '{{ route('admin.backup-database.destroy', $backup['filename']) }}', method: 'DELETE' })"
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
                <p class="text-base">Belum ada file backup. Klik "Buat Backup SQL" untuk memulai.</p>
            </div>
        @endif
    </div>
@endsection
