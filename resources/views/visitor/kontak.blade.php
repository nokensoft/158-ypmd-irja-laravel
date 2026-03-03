@extends('layouts.visitor')
@section('title', 'Kontak - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Hubungi Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Informasi kontak dan alamat ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Hubungi Kami', 'breadcrumb' => 'Kontak'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['icon' => 'fa-map-marker-alt', 'title' => 'Alamat', 'lines' => [$situs['alamat'] ?? 'Belum diatur']],
                    ['icon' => 'fa-phone', 'title' => 'Telepon', 'lines' => [$situs['telepon'] ?? 'Belum diatur']],
                    ['icon' => 'fa-envelope', 'title' => 'Email', 'lines' => [$situs['email'] ?? 'Belum diatur']],
                    ['icon' => 'fa-clock', 'title' => 'Jam Operasional', 'lines' => ['Senin - Jumat', '08:00 - 16:00 WIT']],
                ] as $card)
                    <div class="bg-gray-50 p-8 text-center border-t-4 border-primary hover:shadow-lg transition">
                        <div class="w-14 h-14 bg-primary text-white flex items-center justify-center mx-auto mb-4">
                            <i class="fas {{ $card['icon'] }} text-xl"></i>
                        </div>
                        <h4 class="font-bold uppercase text-base mb-2">{{ $card['title'] }}</h4>
                        @foreach ($card['lines'] as $line)
                            <p class="text-gray-500 text-base">{{ $line }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div x-data="{ sent: false }">
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Pesan</p>
                    <h3 class="text-3xl font-extrabold mb-8">Kirim Pesan</h3>
                    <div x-show="!sent">
                        <form @submit.prevent="sent = true" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Nama Lengkap</label>
                                    <input type="text" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan nama lengkap">
                                </div>
                                <div>
                                    <label class="text-base font-bold uppercase text-gray-500 block mb-2">Email</label>
                                    <input type="email" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition no-round" placeholder="Masukkan email">
                                </div>
                            </div>
                            <div>
                                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Subjek</label>
                                <select required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition bg-white no-round">
                                    <option value="">Pilih Subjek</option>
                                    <option>Informasi Umum</option>
                                    <option>Pendaftaran Atlet</option>
                                    <option>Kerjasama & Sponsorship</option>
                                    <option>Media & Pers</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-base font-bold uppercase text-gray-500 block mb-2">Pesan</label>
                                <textarea rows="5" required class="w-full border border-gray-300 p-4 text-base focus:border-primary focus:outline-none transition resize-none no-round" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-base tracking-wide w-full md:w-auto no-round">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                    <div x-show="sent" x-transition class="bg-green-50 border border-green-200 p-8 text-center">
                        <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                        <h4 class="font-bold text-xl mb-2">Pesan Terkirim!</h4>
                        <p class="text-gray-600 text-base mb-4">Terima kasih telah menghubungi kami. Kami akan merespons pesan Anda sesegera mungkin.</p>
                        <button @click="sent = false" class="text-primary font-bold text-base uppercase hover:underline">Kirim Pesan Lagi</button>
                    </div>
                </div>
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Lokasi</p>
                    <h3 class="text-3xl font-extrabold mb-8">Temukan Kami</h3>
                    <div class="bg-gray-200 h-80 flex items-center justify-center shadow-md">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-map-marked-alt text-4xl mb-3 text-gray-400"></i>
                            <p class="font-bold text-base uppercase">Peta Lokasi</p>
                            <p class="text-sm mt-1">Jl. Trikora No. 1, Wamena</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
