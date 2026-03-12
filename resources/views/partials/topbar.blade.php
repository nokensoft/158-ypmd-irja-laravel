{{-- Topbar: Social Media | Clock | Language Switcher --}}
<div class="bg-neutral-900 text-neutral-400 text-xs hidden md:block relative z-[60]" id="topbar">
    <div class="max-w-7xl mx-auto px-6 py-2.5 flex items-center justify-between">

        {{-- Left: Social Media Links --}}
        <div class="flex items-center gap-3">
            @if (!empty($situs['sosmed_facebook']))
                <a href="{{ $situs['sosmed_facebook'] }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            @endif
            @if (!empty($situs['sosmed_instagram']))
                <a href="{{ $situs['sosmed_instagram'] }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            @endif
            @if (!empty($situs['sosmed_youtube']))
                <a href="{{ $situs['sosmed_youtube'] }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="YouTube">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            @endif
            @if (!empty($situs['sosmed_twitter']))
                <a href="{{ $situs['sosmed_twitter'] }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="X / Twitter">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            @endif
            @if (!empty($situs['sosmed_tiktok']))
                <a href="{{ $situs['sosmed_tiktok'] }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="TikTok">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            @endif
        </div>

        {{-- Right: Clock + Language Switcher --}}
        <div class="flex items-center gap-4">

            {{-- Realtime Date & Time --}}
            <span class="flex items-center gap-1.5 text-neutral-500">
                <i class="fa-regular fa-clock"></i>
                <span id="topbar-clock">—</span>
            </span>

            <span class="text-neutral-700">|</span>

            {{-- Language Switcher --}}
            <div class="relative"
                 x-data="{
                     langOpen: false,
                     currentLang: localStorage.getItem('gt_lang') || 'id',
                     switchLang(lang) {
                         this.currentLang = lang;
                         localStorage.setItem('gt_lang', lang);
                         this.langOpen = false;
                         const trySwitch = (n) => {
                             const sel = document.querySelector('.goog-te-combo');
                             if (sel) {
                                 sel.value = lang;
                                 sel.dispatchEvent(new Event('change'));
                             } else if (n > 0) {
                                 setTimeout(() => trySwitch(n - 1), 300);
                             }
                         };
                         trySwitch(15);
                     }
                 }"
                 @click.outside="langOpen = false">

                <button @click="langOpen = !langOpen"
                        class="flex items-center gap-1.5 hover:text-white transition-colors cursor-pointer select-none">
                    <i class="fa-solid fa-globe text-[10px]"></i>
                    <span x-text="currentLang === 'en' ? 'English' : 'Indonesia'"></span>
                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200"
                       :class="langOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="langOpen" x-transition style="display:none;"
                     class="absolute right-0 top-full mt-1.5 w-36 bg-neutral-800 border border-neutral-700 shadow-lg z-50 overflow-hidden">
                    <button @click="switchLang('id')"
                            class="w-full flex items-center gap-2.5 px-4 py-2.5 hover:bg-neutral-700 hover:text-white transition-colors text-left"
                            :class="currentLang === 'id' ? 'text-white font-semibold' : 'text-neutral-400'">
                        <span class="text-sm">🇮🇩</span> Indonesia
                    </button>
                    <button @click="switchLang('en')"
                            class="w-full flex items-center gap-2.5 px-4 py-2.5 hover:bg-neutral-700 hover:text-white transition-colors text-left"
                            :class="currentLang === 'en' ? 'text-white font-semibold' : 'text-neutral-400'">
                        <span class="text-sm">🇺🇸</span> English
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hidden Google Translate container --}}
<div id="google_translate_element" style="display:none;"></div>

<style>
    /* Sembunyikan toolbar Google Translate bawaan */
    .goog-te-banner-frame, .goog-te-menu-value, .skiptranslate { display: none !important; }
    body { top: 0px !important; }
    #goog-gt-tt, .goog-tooltip, .goog-tooltip-content { display: none !important; }
    .goog-text-highlight { background-color: transparent !important; box-shadow: none !important; }
</style>

<script>
    // Google Translate init callback
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'id,en',
            autoDisplay: false
        }, 'google_translate_element');

        // Restore saved language after translate element is ready
        const saved = localStorage.getItem('gt_lang');
        if (saved && saved !== 'id') {
            const tryRestore = (n) => {
                const sel = document.querySelector('.goog-te-combo');
                if (sel) {
                    sel.value = saved;
                    sel.dispatchEvent(new Event('change'));
                } else if (n > 0) {
                    setTimeout(() => tryRestore(n - 1), 400);
                }
            };
            setTimeout(() => tryRestore(15), 500);
        }
    }

    // Realtime clock
    (function () {
        const el = document.getElementById('topbar-clock');
        if (!el) return;
        function update() {
            const now = new Date();
            el.textContent = now.toLocaleDateString('id-ID', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            }) + '  •  ' + now.toLocaleTimeString('id-ID', {
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
        }
        update();
        setInterval(update, 1000);
    })();
</script>

{{-- Google Translate Script --}}
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

