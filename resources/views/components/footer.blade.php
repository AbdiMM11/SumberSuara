<footer id="main-footer" class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-white mt-20 md:mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4 pb-16 md:pt-6 md:pb-6">

        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            {{-- DESKTOP: LOGO --}}
            <div class="hidden md:block flex-shrink-0">
                <img src="{{ asset('public/images/logo.png') }}" class="h-20 object-contain drop-shadow-lg"
                    alt="Logo Sumber Suara">
            </div>

            {{-- TEKS TENGAH --}}
            <div class="text-center leading-tight w-full">
                <p class="text-sm md:text-lg font-semibold tracking-wide">
                    Sumber Suara — Local Pasti Vocal
                </p>
                <p class="text-[11px] md:text-sm text-gray-200 mt-1">
                    Platform musik independen untuk mempromosikan karya musisi lokal Lampung.
                </p>
                <p class="text-[10px] md:text-sm mt-2 text-gray-300">
                    Copyright © 2025 Sumber Suara — All Rights Reserved
                </p>
            </div>

            {{-- FOR MORE --}}
            <div class="flex flex-col items-center w-full md:w-auto text-center space-y-2">

                <p class="text-xs md:text-base font-semibold tracking-wide whitespace-nowrap">
                    For More Information
                </p>

                {{-- MOBILE ICONS --}}
                <div class="flex md:hidden items-center justify-center space-x-4 mt-4">

                    <a href="https://instagram.com/sumbersuara.lpg" target="_blank"
                        class="hover:opacity-90 transition transform hover:scale-110">
                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-md">
                            <img src="public/icons/instagram.svg" class="w-5 h-5" alt="Instagram">
                        </div>
                    </a>

                    <a href="mailto:sumbersuara.lpg@gmail.com"
                        class="hover:opacity-90 transition transform hover:scale-110">
                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-md">
                            <img src="public/icons/gmail.svg" class="w-5 h-5" alt="Email">
                        </div>
                    </a>

                </div>

                {{-- DESKTOP ICONS --}}
                <div class="hidden md:flex flex-row items-center justify-center space-x-3 text-center">
                    <a href="https://instagram.com/sumbersuara.lpg" target="_blank"
                        class="hover:opacity-90 transition transform hover:scale-110">
                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-md">
                            <img src="public/icons/instagram.svg" class="w-5 h-5" alt="Instagram">
                        </div>
                    </a>

                    <a href="mailto:sumbersuara.lpg@gmail.com"
                        class="hover:opacity-90 transition transform hover:scale-110">
                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-md">
                            <img src="public/icons/gmail.svg" class="w-5 h-5" alt="Email">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.getElementById('main-footer');
        if (!footer) return;

        const playerIds = [
            'desktop-player',
            'mini-player',
            'detail-player',
            'mobile-player'
        ];

        function isVisible(el) {
            if (!el) return false;
            if (el.classList.contains('hidden')) return false;
            const style = window.getComputedStyle(el);
            return style.display !== 'none' &&
                style.visibility !== 'hidden' &&
                style.opacity !== '0';
        }

        function updateFooterVisibility() {
            const anyActive = playerIds.some(id => {
                const el = document.getElementById(id);
                return isVisible(el);
            });

            if (anyActive) {
                footer.classList.add('hidden');
            } else {
                footer.classList.remove('hidden');
            }
        }

        updateFooterVisibility();

        playerIds.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;

            const observer = new MutationObserver(updateFooterVisibility);
            observer.observe(el, {
                attributes: true,
                attributeFilter: ['class', 'style']
            });
        });

        window.addEventListener('player:state-changed', updateFooterVisibility);
    });
</script>
