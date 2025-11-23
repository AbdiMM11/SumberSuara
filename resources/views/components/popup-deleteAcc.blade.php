<div>
    <!-- Overlay -->
    <div id="deleteOverlay" class="fixed inset-0 bg-black bg-opacity-80 hidden z-40 transition-opacity"></div>

    <!-- Popup Container -->
    <div id="deletePopup"
         class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden transform transition-all scale-95">

            <!-- Body -->
            <div class="flex flex-col items-center p-6 bg-gray-50">
                <!-- Icon Warning -->
                <div class="text-red-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.721-1.36 3.486 0l6.518 11.61c.75 1.337-.213 2.99-1.742 2.99H3.48c-1.53 0-2.492-1.653-1.743-2.99L8.257 3.1zM11 14a1 1 0 11-2 0 1 1 0 012 0zm-1-8a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-4.5A.75.75 0 0010 6z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Teks Konfirmasi -->
                <h2 class="text-center text-gray-800 font-semibold text-base md:text-lg mb-6">
                    Apakah anda yakin ingin menghapus akun ini?
                </h2>

                <!-- Tombol Aksi -->
                <div class="flex flex-col md:flex-row gap-4 w-full justify-center">
                    <!-- Tombol Ya -->
                    <button
                        onclick="confirmDelete()"
                        class="w-full md:w-32 bg-blue-900 text-white py-2 rounded-lg font-medium hover:bg-blue-800 transition"
                    >
                        Ya
                    </button>

                    <!-- Tombol Tidak -->
                    <button
                        onclick="closeDeletePopup()"
                        class="w-full md:w-32 bg-gray-300 text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-400 transition"
                    >
                        Tidak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const deletePopup = document.getElementById('deletePopup');
        const deleteOverlay = document.getElementById('deleteOverlay');

        // Membuka Popup
        function openDeletePopup() {
            deletePopup.classList.remove('hidden');
            deleteOverlay.classList.remove('hidden');
            deletePopup.classList.add('scale-100');
        }

        // Menutup Popup
        function closeDeletePopup() {
            deletePopup.classList.add('hidden');
            deleteOverlay.classList.add('hidden');
        }

        // Klik overlay untuk menutup popup
        deleteOverlay.addEventListener('click', closeDeletePopup);

        // Konfirmasi hapus
        function confirmDelete() {
            alert("Akun berhasil dihapus!");
            closeDeletePopup();
        }
    </script>
</div>
