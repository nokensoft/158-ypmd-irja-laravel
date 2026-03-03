/**
 * KONI Papua Pegunungan - Berita (News) Module
 * Fetches data from data/berita.json and provides Alpine.js components.
 */

/* ---- Shared fetch helper ---- */
async function fetchBerita() {
    const res = await fetch('data/berita.json');
    return res.json();
}

document.addEventListener('alpine:init', () => {

    /* ---- Featured section (berita.html top) ---- */
    Alpine.data('beritaFeatured', () => ({
        berita: [],
        headline: null,
        sidebarList: [],
        async init() {
            this.berita = await fetchBerita();
            if (this.berita.length > 0) {
                this.headline = this.berita[0];
                this.sidebarList = this.berita.slice(1, 4);
            }
        }
    }));

    /* ---- Grid + sidebar section (berita.html bottom) ---- */
    Alpine.data('beritaGrid', () => ({
        berita: [],
        activeCategory: 'semua',
        async init() {
            this.berita = await fetchBerita();
        },
        get filteredBerita() {
            if (this.activeCategory === 'semua') return this.berita;
            return this.berita.filter(i => i.kategori.toLowerCase() === this.activeCategory);
        },
        get kategoriList() {
            const cats = [...new Set(this.berita.map(i => i.kategori.toLowerCase()))];
            return ['semua', ...cats];
        },
        get populerList() {
            return this.berita.slice(0, 3);
        }
    }));

    /* ---- Berita Terkini on index.html ---- */
    Alpine.data('beritaTerkini', () => ({
        berita: [],
        async init() {
            this.berita = (await fetchBerita()).slice(0, 3);
        }
    }));

    /* ---- Detail page ---- */
    Alpine.data('beritaDetail', () => ({
        artikel: null,
        beritaLainnya: [],
        notFound: false,
        async init() {
            const params = new URLSearchParams(window.location.search);
            const slug = params.get('slug');
            if (!slug) { this.notFound = true; return; }
            const semua = await fetchBerita();
            this.artikel = semua.find(b => b.slug === slug) || null;
            if (!this.artikel) { this.notFound = true; return; }
            this.beritaLainnya = semua.filter(b => b.slug !== slug).slice(0, 3);
        }
    }));
});
