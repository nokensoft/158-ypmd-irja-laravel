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

Alpine.start();
