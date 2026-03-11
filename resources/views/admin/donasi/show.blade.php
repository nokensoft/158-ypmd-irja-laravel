@extends('layouts.dashboard')
@section('title', 'Detail Donasi — ' . $donasi->nama_donatur)
@section('page-title', 'Detail Donasi')
@section('content')

    <div class="max-w-3xl">

        {{-- Status banner --}}
        <div class="mb-6 px-5 py-4 font-semibold text-sm
            {{ $donasi->status === 'dikonfirmasi' ? 'bg-green-50 border border-green-200 text-green-800' :
               ($donasi->status === 'ditolak' ? 'bg-red-50 border border-red-200 text-red-700' : 'bg-yellow-50 border border-yellow-200 text-yellow-800') }}">
            <i class="fas {{ $donasi->status === 'dikonfirmasi' ? 'fa-check-circle' : ($donasi->status === 'ditolak' ? 'fa-times-circle' : 'fa-clock') }} mr-2"></i>
            Status: <strong>{{ $donasi->status_label }}</strong>
            @if ($donasi->catatan_admin)
                &mdash; {{ $donasi->catatan_admin }}
            @endif
        </div>

        {{-- Detail Card --}}
        <div class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-base font-bold uppercase text-gray-400 mb-5 pb-3 border-b border-gray-100">Informasi Donatur</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Nama</dt>
                    <dd class="text-gray-800 font-semibold">{{ $donasi->nama_donatur }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Email</dt>
                    <dd class="text-gray-700">{{ $donasi->email ?: '-' }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Telepon</dt>
                    <dd class="text-gray-700">{{ $donasi->telepon ?: '-' }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Bank</dt>
                    <dd class="text-gray-700 font-semibold">{{ $donasi->bank }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Jumlah</dt>
                    <dd class="text-primary font-bold text-lg">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Tanggal</dt>
                    <dd class="text-gray-700">
                        {{ $donasi->tanggal ? \Carbon\Carbon::parse($donasi->tanggal)->translatedFormat('d M Y') : $donasi->created_at->translatedFormat('d M Y H:i') }}
                    </dd>
                </div>
                @if ($donasi->pesan)
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Pesan</dt>
                    <dd class="text-gray-700 italic">{{ $donasi->pesan }}</dd>
                </div>
                @endif
            </dl>

            {{-- Bukti Transfer --}}
            @if ($donasi->bukti_transfer)
                <div class="mt-6 pt-5 border-t border-gray-100">
                    <p class="text-xs font-bold uppercase text-gray-400 mb-3">Bukti Transfer</p>
                    @php $ext = strtolower(pathinfo($donasi->bukti_transfer, PATHINFO_EXTENSION)); @endphp
                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                        <a href="{{ asset('storage/' . $donasi->bukti_transfer) }}" target="_blank">
                            <img src="{{ asset('storage/' . $donasi->bukti_transfer) }}"
                                 alt="Bukti Transfer"
                                 class="max-w-sm border border-gray-200 hover:opacity-90 transition">
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $donasi->bukti_transfer) }}" target="_blank"
                           class="inline-flex items-center gap-2 bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition no-round">
                            <i class="fas fa-file-pdf text-red-500"></i> Lihat Bukti Transfer
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- Aksi: Konfirmasi / Tolak --}}
        @if ($donasi->status === 'pending')
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-base font-bold uppercase text-gray-400 mb-5">Tindakan Admin</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                {{-- Konfirmasi --}}
                <form action="{{ route('admin.donasi.konfirmasi', $donasi->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="text-xs font-bold uppercase text-gray-400 block mb-1">Catatan (opsional)</label>
                        <input type="text" name="catatan_admin"
                               class="w-full border border-gray-300 p-3 text-sm focus:border-green-500 focus:outline-none transition no-round"
                               placeholder="Catatan konfirmasi...">
                    </div>
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-3 font-bold uppercase text-sm hover:bg-green-700 transition no-round"
                            onclick="return confirm('Konfirmasi donasi ini?')">
                        <i class="fas fa-check mr-2"></i>Konfirmasi Donasi
                    </button>
                </form>
                {{-- Tolak --}}
                <form action="{{ route('admin.donasi.tolak', $donasi->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="text-xs font-bold uppercase text-gray-400 block mb-1">Alasan penolakan</label>
                        <input type="text" name="catatan_admin"
                               class="w-full border border-gray-300 p-3 text-sm focus:border-red-400 focus:outline-none transition no-round"
                               placeholder="Tuliskan alasan...">
                    </div>
                    <button type="submit"
                            class="w-full bg-red-500 text-white py-3 font-bold uppercase text-sm hover:bg-red-600 transition no-round"
                            onclick="return confirm('Tolak donasi ini?')">
                        <i class="fas fa-times mr-2"></i>Tolak Donasi
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- Delete + Kembali --}}
        <div class="flex gap-3 mt-6">
            <a href="{{ route('admin.donasi.index') }}"
               class="bg-gray-200 text-gray-700 px-6 py-3 font-bold uppercase text-sm hover:bg-gray-300 transition no-round">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <form action="{{ route('admin.donasi.destroy', $donasi->id) }}" method="POST"
                  onsubmit="return confirm('Hapus data donasi ini permanen?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="bg-gray-700 text-white px-6 py-3 font-bold uppercase text-sm hover:bg-red-700 transition no-round">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </form>
        </div>
    </div>

@endsection
