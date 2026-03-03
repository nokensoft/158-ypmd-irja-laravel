/**
 * Header Partial
 * Mimics Laravel's @include('partials.header')
 * Injected before Alpine.js initializes so directives are processed.
 */
(function () {
    const page = document.body.dataset.page || 'beranda';

    const nav = [
        { label: 'Beranda', href: 'index.html', id: 'beranda' },
        { label: 'Tentang', href: 'tentang.html', id: 'tentang' },
        { label: 'Pengurusan', href: 'pengurusan.html', id: 'pengurusan' },
        { label: 'Cabor', href: 'cabor.html', id: 'cabor' },
        { label: 'Event', href: 'event.html', id: 'event' },
        { label: 'Berita', href: 'berita.html', id: 'berita' },
        { label: 'Galeri', href: 'galeri.html', id: 'galeri' },
        { label: 'Kontak', href: 'kontak.html', id: 'kontak' }
    ];

    const navLinks = nav.map(function (item) {
        const active = item.id === page ? ' text-primary font-bold' : '';
        const kontak = item.id === 'kontak' ? ' border-l-0 lg:border-l lg:border-gray-300 pl-0 lg:pl-6' : '';
        return '<a href="' + item.href + '" class="hover:text-primary transition' + active + kontak + '">' + item.label + '</a>';
    }).join('\n                ');

    const html = `
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center lg:flex-row flex-col" x-data="{ mobileMenuOpen: false }">
            <div class="flex items-center space-x-3 lg:w-auto w-full justify-center lg:justify-start relative">
                <a href="index.html" class="flex items-center space-x-3">
                    <img src="./assets/img/logo-koni-papua-pegunungan-transparant.png" alt="Logo KONI" class="h-12">
                    <div class="text-center lg:text-left">
                        <span class="font-bold text-lg leading-none text-primary block">KONI</span>
                        <span class="text-xs font-semibold tracking-widest uppercase block">Papua Pegunungan</span>
                    </div>
                </a>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden absolute right-0 text-2xl">
                    <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
            <div :class="mobileMenuOpen ? 'flex' : 'hidden'" class="lg:flex flex-col lg:flex-row lg:space-x-6 space-y-4 lg:space-y-0 mt-4 lg:mt-0 items-center text-sm font-medium uppercase tracking-tight">
                ${navLinks}
            </div>
        </nav>
    </header>`;

    const el = document.getElementById('header-partial');
    if (el) el.outerHTML = html;
})();
