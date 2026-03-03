<footer class="bg-dark text-white pt-16 pb-8">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
        <div>
            <a href="{{ route('beranda') }}" class="inline-block">
                @if (!empty($situs['logo']))
                    <img src="{{ asset('storage/' . $situs['logo']) }}" class="h-50 mb-4 brightness-200" alt="Logo {{ $situs['nama_situs'] ?? 'KONI' }}">
                @else
                    <img src="{{ asset('img/logo-koni-papua-pegunungan-transparant.png') }}" class="h-50 mb-4 brightness-200" alt="Logo KONI">
                @endif
            </a>
            <p class="text-base text-gray-400 leading-relaxed">{{ $situs['deskripsi_situs'] ?? 'Wadah pembinaan olahraga prestasi di Provinsi Papua Pegunungan.' }}</p>
        </div>
        <div>
            <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Navigasi</h4>
            <ul class="text-base space-y-3 text-gray-400">
                <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang Kami</a></li>
                <li><a href="{{ route('pengurusan') }}" class="hover:text-white transition">Struktur Organisasi</a></li>
                <li><a href="{{ route('cabor') }}" class="hover:text-white transition">Cabang Olahraga</a></li>
                <li><a href="{{ route('event') }}" class="hover:text-white transition">Event</a></li>
                <li><a href="{{ route('berita') }}" class="hover:text-white transition">Berita</a></li>
                <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Link Terkait</h4>
            <ul class="text-base space-y-3 text-gray-400">
                <li><a href="https://kfrfroni.or.id" target="_blank" class="hover:text-white transition">KONI Pusat</a></li>
                <li><a href="https://kemenpora.go.id" target="_blank" class="hover:text-white transition">Kemenpora RI</a></li>
                <li><a href="#" class="hover:text-white transition">Dispora Papua Pegunungan</a></li>
                <li><a href="#" class="hover:text-white transition">Pemerintah Provinsi</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Hubungi Kami</h4>
            <ul class="text-base space-y-3 text-gray-400">
                @if (!empty($situs['alamat']))
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                        <span>{{ $situs['alamat'] }}</span>
                    </li>
                @endif
                @if (!empty($situs['telepon']))
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-primary"></i>
                        <span>{{ $situs['telepon'] }}</span>
                    </li>
                @endif
                @if (!empty($situs['email']))
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-primary"></i>
                        <a href="mailto:{{ $situs['email'] }}" class="hover:text-white transition">{{ $situs['email'] }}</a>
                    </li>
                @endif
            </ul>
            @php
                $sosmedList = [
                    ['key' => 'sosmed_facebook', 'icon' => 'fab fa-facebook-f'],
                    ['key' => 'sosmed_instagram', 'icon' => 'fab fa-instagram'],
                    ['key' => 'sosmed_youtube', 'icon' => 'fab fa-youtube'],
                    ['key' => 'sosmed_twitter', 'icon' => 'fab fa-twitter'],
                    ['key' => 'sosmed_tiktok', 'icon' => 'fab fa-tiktok'],
                ];
            @endphp
            <div class="flex space-x-3 mt-6">
                @foreach ($sosmedList as $sm)
                    @if (!empty($situs[$sm['key']]))
                        <a href="{{ $situs[$sm['key']] }}" target="_blank" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-base"><i class="{{ $sm['icon'] }}"></i></a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 border-t border-gray-800 pt-8 text-center text-sm text-gray-500 uppercase tracking-widest">
        &copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan' }}. All Rights Reserved.
    </div>
</footer>
