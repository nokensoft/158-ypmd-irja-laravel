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
            @if ($donasi->programDonasi)
            <div class="mb-5 pb-5 border-b border-gray-100">
                <p class="text-xs font-bold uppercase text-gray-400 mb-2">Program Donasi</p>
                <p class="font-bold text-gray-800">{{ $donasi->programDonasi->judul }}</p>
            </div>
            @endif
            <h3 class="text-base font-bold uppercase text-gray-400 mb-5 pb-3 border-b border-gray-100">Informasi Donatur</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex gap-4">
                    <dt class="w-36 font-semibold text-gray-500 uppercase text-xs flex-shrink-0">Nama</dt>
                    <dd class="text-gray-800 font-semibold">
                        {{ $donasi->nama_donatur }}
                        @if ($donasi->is_anonim)
                            <span class="ml-2 px-2 py-0.5 text-xs bg-gray-100 text-gray-500 font-bold uppercase">Anonim</span>
                        @endif
                    </dd>
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
                @php $ext = strtolower(pathinfo($donasi->bukti_transfer, PATHINFO_EXTENSION)); @endphp
                <div class="mt-6 pt-5 border-t border-gray-100">
                    <p class="text-xs font-bold uppercase text-gray-400 mb-3">Bukti Transfer</p>
                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                        {{-- Thumbnail klik untuk modal --}}
                        <button type="button" onclick="openBuktiModal()"
                                class="block border border-gray-200 hover:border-primary transition focus:outline-none">
                            <img src="{{ route('penulis.donasi.bukti-transfer', $donasi->id) }}"
                                 alt="Bukti Transfer"
                                 class="max-w-xs object-cover hover:opacity-90 transition">
                        </button>
                        <p class="text-xs text-gray-400 mt-2"><i class="fas fa-search-plus mr-1"></i>Klik gambar untuk perbesar</p>
                    @else
                        {{-- PDF / file lain --}}
                        <div class="flex items-center gap-3">
                            <a href="{{ route('penulis.donasi.bukti-transfer', $donasi->id) }}" target="_blank"
                               class="inline-flex items-center gap-2 bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition no-round">
                                <i class="fas fa-file-pdf text-red-500"></i> Buka / Lihat PDF
                            </a>
                            <a href="{{ route('penulis.donasi.bukti-transfer', $donasi->id) }}" download
                               class="inline-flex items-center gap-2 bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition no-round">
                                <i class="fas fa-download text-gray-500"></i> Unduh
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Modal Lightbox --}}
                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                <div id="buktiModal"
                     class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-80 p-4"
                     onclick="closeBuktiModal()">
                    <div class="relative max-w-3xl w-full" onclick="event.stopPropagation()">
                        <button onclick="closeBuktiModal()"
                                class="absolute -top-10 right-0 text-white text-2xl font-bold hover:text-gray-300 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                        <img src="{{ route('penulis.donasi.bukti-transfer', $donasi->id) }}"
                             alt="Bukti Transfer"
                             class="w-full object-contain max-h-screen">
                        <div class="mt-3 flex justify-end">
                            <a href="{{ route('penulis.donasi.bukti-transfer', $donasi->id) }}" download
                               class="inline-flex items-center gap-2 bg-white text-gray-800 px-4 py-2 text-xs font-bold uppercase hover:bg-gray-100 transition no-round"
                               onclick="event.stopPropagation()">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <script>
                    function openBuktiModal()  { document.getElementById('buktiModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
                    function closeBuktiModal() { document.getElementById('buktiModal').classList.add('hidden'); document.body.style.overflow = ''; }
                    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeBuktiModal(); });
                </script>
                @endif
            @else
                <div class="mt-6 pt-5 border-t border-gray-100">
                    <p class="text-xs font-bold uppercase text-gray-400 mb-3">Bukti Transfer</p>
                    <p class="text-sm text-gray-400 italic">Tidak ada file bukti transfer.</p>
                </div>
            @endif
        </div>

        {{-- Aksi: Konfirmasi / Tolak --}}
        @if ($donasi->status === 'pending')
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-base font-bold uppercase text-gray-400 mb-5">Tindakan</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                {{-- Konfirmasi --}}
                <form action="{{ route('penulis.donasi.konfirmasi', $donasi->id) }}" method="POST">
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
                <form action="{{ route('penulis.donasi.tolak', $donasi->id) }}" method="POST">
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
            <a href="{{ route('penulis.donasi.index') }}"
               class="bg-gray-200 text-gray-700 px-6 py-3 font-bold uppercase text-sm hover:bg-gray-300 transition no-round">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <form action="{{ route('penulis.donasi.destroy', $donasi->id) }}" method="POST"
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
