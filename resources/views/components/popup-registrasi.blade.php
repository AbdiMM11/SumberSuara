{{-- resources/views/components/popup-registrasi.blade.php --}}
<div>
    <!-- Overlay -->
    <div id="popupRegistrasiOverlay"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-40 opacity-0 transition-opacity duration-300"></div>

    <!-- Popup Container -->
    <div id="popupRegistrasi"
         class="hidden fixed inset-0 z-50 flex items-center justify-center px-4
                opacity-0 translate-y-3 scale-95 transition-all duration-300 ease-out">

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm md:max-w-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-5 pt-4 pb-2 border-b border-gray-100">

                <div class="flex items-center gap-3">

                    {{-- LOGO SUMBER SUARA --}}
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Logo Sumber Suara"
                         class="h-10 w-10 object-contain rounded-lg shadow-sm">

                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pilih Tipe Akun</p>
                        <p class="text-xs text-gray-500">Sumber Suara • Local Pasti Vocal</p>
                    </div>
                </div>

                {{-- Tombol close --}}
                <button type="button"
                        onclick="closeRegisterPopup()"
                        class="p-1.5 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="flex flex-col items-center px-6 pb-6 pt-4 bg-gray-50">

                {{-- Ilustrasi PILIH JENIS AKUN --}}
                <div class="mb-4">
                    <div class="h-16 w-16 rounded-2xl bg-white flex items-center justify-center shadow-lg">
                        <img src="{{ asset('images/jenis-akun.png') }}"
                             alt="Pilih Jenis Akun"
                             class="h-12 w-12 object-contain">
                    </div>
                </div>

                {{-- Teks --}}
                <h2 class="text-center text-gray-900 font-semibold text-base md:text-lg mb-2">
                    Anda mendaftar sebagai siapa?
                </h2>

                <p class="text-center text-xs text-gray-500 mb-5 max-w-xs">
                    Pilih peran yang paling sesuai. Kamu tetap bisa menikmati musik lokal Lampung, apapun pilihanmu.
                </p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col gap-3 w-full">

                    {{-- Kartu Musisi --}}
                    <button type="button"
                            onclick="pilihMusisi()"
                            class="group w-full rounded-xl border border-blue-100 bg-white px-4 py-3 text-left
                                   hover:border-blue-500 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100">
                                <img src="{{ asset('images/logo-musisi.png') }}"
                                     alt="Akun Musisi"
                                     class="h-7 w-7 object-contain">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">
                                    Musisi / Band
                                </p>
                                <p class="text-xs text-gray-500">
                                    Upload lagu original, kelola profil, dan promosikan karya ke audience lokal.
                                </p>
                            </div>
                            <span
                                class="text-xs font-semibold text-blue-600 group-hover:translate-x-0.5 transition-transform">
                                Pilih
                            </span>
                        </div>
                    </button>

                    {{-- Kartu Audiens --}}
                    <button type="button"
                            onclick="pilihAudience()"
                            class="group w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-left
                                   hover:border-blue-400 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-blue-50">
                                <img src="{{ asset('images/logo-audiens.png') }}"
                                     alt="Akun Audiens"
                                     class="h-7 w-7 object-contain">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">
                                    Audiens / Penikmat Musik
                                </p>
                                <p class="text-xs text-gray-500">
                                    Jelajahi musisi lokal, simpan lagu favorit, dan ikuti perkembangan event.
                                </p>
                            </div>
                            <span
                                class="text-xs font-semibold text-blue-600 group-hover:translate-x-0.5 transition-transform">
                                Pilih
                            </span>
                        </div>
                    </button>
                </div>

                <p class="mt-4 text-[11px] text-gray-400 text-center">
                    Pilihan ini dapat disesuaikan kembali di pengaturan akun di kemudian hari.
                </p>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const popupRegistrasi = document.getElementById('popupRegistrasi');
        const popupRegistrasiOverlay = document.getElementById('popupRegistrasiOverlay');

        function openRegisterPopup() {
            if (!popupRegistrasi || !popupRegistrasiOverlay) return;

            popupRegistrasi.classList.remove('hidden');
            popupRegistrasiOverlay.classList.remove('hidden');

            requestAnimationFrame(() => {
                popupRegistrasi.classList.remove('opacity-0', 'translate-y-3', 'scale-95');
                popupRegistrasi.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                popupRegistrasiOverlay.classList.remove('opacity-0');
                popupRegistrasiOverlay.classList.add('opacity-100');
            });
        }

        function closeRegisterPopup() {
            if (!popupRegistrasi || !popupRegistrasiOverlay) return;

            popupRegistrasi.classList.add('opacity-0', 'translate-y-3', 'scale-95');
            popupRegistrasi.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            popupRegistrasiOverlay.classList.add('opacity-0');
            popupRegistrasiOverlay.classList.remove('opacity-100');

            setTimeout(() => {
                popupRegistrasi.classList.add('hidden');
                popupRegistrasiOverlay.classList.add('hidden');
            }, 250);
        }

        if (popupRegistrasiOverlay) {
            popupRegistrasiOverlay.addEventListener('click', closeRegisterPopup);
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeRegisterPopup();
        });

        function pilihMusisi() {
            window.location.href = "{{ route('signup.musisi') }}";
        }

        function pilihAudience() {
            window.location.href = "{{ route('signup.audience') }}";
        }
    </script>
</div>
