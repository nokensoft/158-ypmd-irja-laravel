import './bootstrap';

// Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Scroll-to-top
Alpine.data('scrollTop', () => ({
    visible: false,
    init() {
        window.addEventListener('scroll', () => {
            this.visible = window.scrollY > 400;
        });
    },
    goTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}));

// Hero Slider
Alpine.data('heroSlider', () => ({
    current: 0,
    slides: [
        'img/bg/man-futsal-papua-pegunungan.png',
        'img/bg/papua-pegunungan-dayung.png',
        'img/bg/woman-foodbal-papua-pegunungan.png',
    ],
    interval: null,
    init() {
        this.startAutoplay();
    },
    startAutoplay() {
        this.interval = setInterval(() => this.next(), 5000);
    },
    stopAutoplay() {
        clearInterval(this.interval);
    },
    next() {
        this.current = (this.current + 1) % this.slides.length;
    },
    goTo(index) {
        this.current = index;
        this.stopAutoplay();
        this.startAutoplay();
    },
}));

Alpine.start();
