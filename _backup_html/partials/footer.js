/**
 * Footer Partial
 * Mimics Laravel's @include('partials.footer')
 */
(function () {
    const html = `
    <footer class="bg-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div>
                <a href="index.html" class="inline-block">
                    <img src="./assets/img/logo-koni-papua-pegunungan-transparant.png" class="h-50 mb-4 brightness-200" alt="Logo KONI">
                </a>
                <p class="text-sm text-gray-400 leading-relaxed">Wadah pembinaan olahraga prestasi di Provinsi Papua Pegunungan untuk mewujudkan Indonesia yang lebih sehat dan berprestasi.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide">Navigasi</h4>
                <ul class="text-sm space-y-3 text-gray-400">
                    <li><a href="tentang.html" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="pengurusan.html" class="hover:text-white transition">Struktur Organisasi</a></li>
                    <li><a href="cabor.html" class="hover:text-white transition">Cabang Olahraga</a></li>
                    <li><a href="event.html" class="hover:text-white transition">Event</a></li>
                    <li><a href="berita.html" class="hover:text-white transition">Berita</a></li>
                    <li><a href="galeri.html" class="hover:text-white transition">Galeri</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide">Link Terkait</h4>
                <ul class="text-sm space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">KONI Pusat</a></li>
                    <li><a href="#" class="hover:text-white transition">Kemenpora RI</a></li>
                    <li><a href="#" class="hover:text-white transition">Dispora Papua Pegunungan</a></li>
                    <li><a href="#" class="hover:text-white transition">Pemerintah Provinsi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide">Hubungi Kami</h4>
                <ul class="text-sm space-y-3 text-gray-400">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                        <span>Jl. Trikora No. 1, Wamena, Jayawijaya, Papua Pegunungan</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-primary"></i>
                        <span>(0969) 31000</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-primary"></i>
                        <a href="kontak.html" class="hover:text-white transition">info@konipapuapegunungan.id</a>
                    </li>
                </ul>
                <div class="flex space-x-3 mt-6">
                    <a href="#" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-sm"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-sm"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-sm"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-sm"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 border-t border-gray-800 pt-8 text-center text-xs text-gray-500 uppercase tracking-widest">
            &copy; 2026 KONI Provinsi Papua Pegunungan. All Rights Reserved.
        </div>
    </footer>`;

    const el = document.getElementById('footer-partial');
    if (el) el.outerHTML = html;
})();
