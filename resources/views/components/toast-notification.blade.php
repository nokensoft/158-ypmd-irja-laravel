{{-- Toast Notification --}}
<div x-data="{ show: false, message: '' }"
     x-on:notify.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 2500)"
     x-show="show" x-cloak
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-2"
     class="fixed bottom-6 right-6 z-[999] bg-dark text-white px-5 py-3 shadow-lg flex items-center gap-3 text-sm font-medium">
    <i class="fas fa-check-circle text-primary"></i>
    <span x-text="message"></span>
</div>
