<div>
    <!-- Overlay -->
    <div id="deleteOverlay"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-40 opacity-0 transition-opacity duration-300"></div>

    <!-- Popup Container -->
    <div id="deletePopup"
         class="hidden fixed inset-0 z-50 flex items-center justify-center px-4
                opacity-0 translate-y-3 scale-95 transition-all duration-300 ease-out">
        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm md:max-w-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-5 pt-4 pb-2 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full bg-red-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 100 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM8 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Hapus Karya</p>
                        <p class="text-xs text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>

                {{-- Tombol close --}}
                <button type="button"
                        onclick="closeDeletePopup()"
                        class="p-1.5 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="flex flex-col items-center px-6 pb-6 pt-4 bg-gray-50">
                <!-- Icon Warning -->
                <div class="text-red-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.721-1.36 3.486 0l6.518 11.61c.75 1.337-.213 2.99-1.742 2.99H3.48c-1.53 0-2.492-1.653-1.743-2.99L8.257 3.1zM11 14a1 1 0 11-2 0 1 1 0 012 0zm-1-8a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-4.5A.75.75 0 0010 6z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Teks Konfirmasi -->
                <h2 class="text-center text-gray-800 font-semibold text-base md:text-lg mb-2">
                    Apakah Anda yakin ingin menghapus karya ini?
                </h2>
                <p class="text-center text-xs text-gray-500 mb-5 max-w-xs">
                    Karya yang sudah dihapus tidak dapat dikembalikan dan akan hilang dari daftar karya Anda.
                </p>

                <!-- Tombol Aksi -->
                <div class="flex flex-col md:flex-row gap-3 w-full justify-center">
                    <!-- Form delete (submit DELETE ke URL dinamis) -->
                    <form id="deleteKaryaForm" method="POST" class="w-full md:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full md:w-32 bg-red-600 text-white py-2 rounded-lg text-sm font-medium
                                       hover:bg-red-700 transition shadow-sm">
                            Ya, Hapus
                        </button>
                    </form>

                    <!-- Tombol Batal -->
                    <button type="button"
                            onclick="closeDeletePopup()"
                            class="w-full md:w-32 bg-gray-200 text-gray-800 py-2 rounded-lg text-sm font-medium
                                   hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const deletePopup   = document.getElementById('deletePopup');
        const deleteOverlay = document.getElementById('deleteOverlay');
        const deleteForm    = document.getElementById('deleteKaryaForm');

        // Membuka Popup (button = element tombol hapus yang diklik)
        function openDeletePopup(button) {
            if (!deletePopup || !deleteOverlay || !deleteForm) return;

            const url = button.getAttribute('data-delete-url');
            deleteForm.setAttribute('action', url);

            deletePopup.classList.remove('hidden');
            deleteOverlay.classList.remove('hidden');

            requestAnimationFrame(() => {
                deletePopup.classList.remove('opacity-0', 'translate-y-3', 'scale-95');
                deletePopup.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                deleteOverlay.classList.remove('opacity-0');
                deleteOverlay.classList.add('opacity-100');
            });
        }

        // Menutup Popup
        function closeDeletePopup() {
            if (!deletePopup || !deleteOverlay) return;

            deletePopup.classList.add('opacity-0', 'translate-y-3', 'scale-95');
            deletePopup.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            deleteOverlay.classList.add('opacity-0');
            deleteOverlay.classList.remove('opacity-100');

            setTimeout(() => {
                deletePopup.classList.add('hidden');
                deleteOverlay.classList.add('hidden');
            }, 250);
        }

        // Klik overlay untuk menutup popup
        if (deleteOverlay) {
            deleteOverlay.addEventListener('click', closeDeletePopup);
        }

        // Tutup dengan ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeletePopup();
            }
        });
    </script>
</div>
