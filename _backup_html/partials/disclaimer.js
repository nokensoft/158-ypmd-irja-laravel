/**
 * Disclaimer Partial
 * Mimics Laravel's @include('partials.disclaimer')
 * Modal disclaimer ditampilkan di setiap halaman saat pertama kali dimuat.
 */
(function () {
    const html = `
    <div x-data="{ open: true }" x-show="open" x-transition.opacity.duration.300ms
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999] flex items-center justify-center p-4">
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white max-w-md w-full shadow-2xl relative overflow-hidden"
             @click.stop>

            <!-- Header -->
            <div class="bg-primary px-6 py-5 text-white text-center">
                <div class="w-14 h-14 bg-white/20 flex items-center justify-center mx-auto mb-3 rounded-full">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <h3 class="text-lg font-extrabold uppercase tracking-wide">Disclaimer</h3>
                <p class="text-red-100 text-xs mt-1 uppercase tracking-widest">Website Demo</p>
            </div>

            <!-- Body -->
            <div class="px-6 py-6">
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>Situs web ini adalah <strong class="text-dark">situs demo</strong> yang dibuat semata-mata untuk keperluan demonstrasi.</p>
                    <p>Seluruh konten yang ditampilkan, termasuk teks dan foto, dihasilkan menggunakan <strong class="text-dark">kecerdasan buatan (AI)</strong>.</p>
                    <p>Informasi di dalam situs ini <strong class="text-dark">tidak merepresentasikan</strong> data resmi dari organisasi mana pun.</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 pb-6">
                <button @click="open = false"
                        class="w-full bg-primary text-white py-3 font-bold hover:bg-red-700 transition uppercase text-sm tracking-wide">
                    <i class="fas fa-check mr-2"></i> Saya Mengerti
                </button>
                <p class="text-center text-xs text-gray-400 mt-4">&copy; 2026 <a href="https://nokensoft.com" target="_blank" class="text-primary hover:underline font-medium">nokensoft.com</a> &mdash; All rights reserved.</p>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML('afterbegin', html);
})();
