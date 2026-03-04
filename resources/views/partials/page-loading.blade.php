{{-- Page Loading Overlay --}}
<div id="page-loading" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="flex space-x-3">
        <span class="loading-circle bg-blue-600"></span>
        <span class="loading-circle bg-yellow-400"></span>
        <span class="loading-circle bg-black"></span>
        <span class="loading-circle bg-green-600"></span>
    </div>
</div>

<style>
    .loading-circle {
        width: 18px;
        height: 18px;
        border-radius: 9999px;
        display: inline-block;
        animation: loadingBounce 1.2s ease-in-out infinite;
    }
    .loading-circle:nth-child(1) { animation-delay: 0s; }
    .loading-circle:nth-child(2) { animation-delay: 0.15s; }
    .loading-circle:nth-child(3) { animation-delay: 0.3s; }
    .loading-circle:nth-child(4) { animation-delay: 0.45s; }

    @keyframes loadingBounce {
        0%, 80%, 100% { transform: scale(0.6); opacity: 0.4; }
        40% { transform: scale(1.2); opacity: 1; }
    }
</style>

<script>
    window.addEventListener('load', function () {
        var loader = document.getElementById('page-loading');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(function () {
                loader.style.display = 'none';
            }, 500);
        }
    });
</script>
