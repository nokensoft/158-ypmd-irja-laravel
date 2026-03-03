/**
 * KONI Papua Pegunungan - Main Application Scripts
 * Registers global Alpine.js data/stores.
 */
document.addEventListener('alpine:init', () => {

    // Scroll-to-top visibility
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

});
