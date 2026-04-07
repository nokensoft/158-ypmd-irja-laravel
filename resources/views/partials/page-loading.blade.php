{{-- Page Loading Overlay --}}
<div id="page-loading" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
    <div id="loader-content" class="loader-content">
        <div id="loader-logo" class="loader-logo">
            @if (!empty($situs['logo']))
                <img src="{{ asset('storage/' . $situs['logo']) }}" alt="{{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}" class="h-20 w-auto md:h-28">
            @else
                <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="{{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}" class="h-20 w-auto md:h-28">
            @endif
        </div>

        <div class="loader-text-mask">
            <div id="loader-text" class="loader-text">
                <span class="block font-display text-2xl font-bold leading-tight text-primary-700 md:text-4xl">
                    {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}
                </span>
                <span class="block text-sm leading-snug text-neutral-400 md:text-base">
                    Yayasan Pembangunan Masyarakat Desa Irian Jaya
                </span>
            </div>
        </div>
    </div>
</div>

<style>
    #page-loading {
        opacity: 1;
        transition: opacity 0.55s ease;
    }

    .loader-content {
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translateX(0);
        transition: transform 0.65s cubic-bezier(.4, 0, .2, 1);
    }

    .loader-logo {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
        opacity: 0;
        transform: scale(0.35);
    }

    .loader-text-mask {
        overflow: hidden;
        max-width: 0;
        margin-left: 0;
        transition: max-width 0.7s cubic-bezier(.4, 0, .2, 1), margin-left 0.7s cubic-bezier(.4, 0, .2, 1);
    }

    .loader-text {
        opacity: 0;
        transform: translateX(-36px);
        white-space: nowrap;
        transition: opacity 0.4s ease, transform 0.7s cubic-bezier(.4, 0, .2, 1);
    }

    .loader-logo.is-visible {
        animation: loaderLogoZoom 0.6s cubic-bezier(.25, .8, .25, 1) forwards;
    }

    .loader-text-mask.is-visible {
        max-width: 34rem;
        margin-left: 1rem;
    }

    .loader-text.is-visible {
        opacity: 1;
        transform: translateX(0);
    }

    .loader-content.is-shifted {
        transform: translateX(-48px);
    }

    #page-loading.is-hidden {
        opacity: 0;
    }

    @keyframes loaderLogoZoom {
        0% {
            opacity: 0;
            transform: scale(0.35);
        }
        65% {
            opacity: 1;
            transform: scale(1.08);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @media (max-width: 640px) {
        .loader-text-mask.is-visible {
            max-width: 18rem;
        }

        .loader-content.is-shifted {
            transform: translateX(-20px);
        }
    }
</style>

<script>
    (function () {
        var overlay = document.getElementById('page-loading');
        var content = document.getElementById('loader-content');
        var logo = document.getElementById('loader-logo');
        var textMask = document.querySelector('.loader-text-mask');
        var text = document.getElementById('loader-text');
        var animationStart = performance.now();
        var animationMinimumDuration = 2100;

        if (!overlay || !content || !logo || !textMask || !text) {
            return;
        }

        logo.classList.add('is-visible');

        setTimeout(function () {
            textMask.classList.add('is-visible');
            text.classList.add('is-visible');
        }, 650);

        setTimeout(function () {
            content.classList.add('is-shifted');
        }, 1400);

        window.addEventListener('load', function () {
            var elapsed = performance.now() - animationStart;
            var remaining = Math.max(0, animationMinimumDuration - elapsed);

            setTimeout(function () {
                overlay.classList.add('is-hidden');

                setTimeout(function () {
                    overlay.style.display = 'none';
                }, 550);
            }, remaining);
        });
    })();
</script>
