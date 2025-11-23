<!-- Music Player lengkap (desktop, mini, detail) dengan revisi modern dan fungsional -->

<!-- Desktop Player -->
<div id="desktop-player"
     class="fixed bottom-0 inset-x-0 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]
            text-white py-4 px-4 md:px-6 z-40 shadow-[0_-8px_25px_rgba(0,0,0,0.35)]
            border-t border-white/10 hidden">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

        <!-- Info Lagu dengan cover -->
        <div class="flex items-center gap-3 min-w-0 overflow-hidden">
            <div class="w-11 h-11 rounded-xl overflow-hidden bg-white/10 border border-white/20">
                <img id="desktop-cover" src="public/images/placeholder.jpg"
                     class="w-full h-full object-cover"
                     alt="Cover" />
            </div>
            <div class="min-w-0">
                <p id="song-title" class="font-semibold text-sm md:text-base truncate">
                    Pilih lagu
                </p>
                <p id="song-artist" class="text-[11px] md:text-xs text-gray-200 truncate">
                    -
                </p>
            </div>
        </div>

        <!-- Kontrol -->
        <div class="flex flex-col items-center space-y-2 w-1/2 max-w-xl">

            <div class="flex items-center gap-4 md:gap-6">
                <button id="love-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img src="public/icons/love.svg" class="w-4 h-4" alt="Love" />
                </button>
                <button id="repeat-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img src="public/icons/repeat.svg" class="w-4 h-4" alt="Repeat" />
                </button>
                <button id="prev-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img src="public/icons/prev.svg" class="w-4 h-4" alt="Previous" />
                </button>
                <button id="play-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img id="play-icon" src="public/icons/play.svg" class="w-6 h-6" alt="Play" />
                </button>
                <button id="next-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img src="public/icons/next.svg" class="w-4 h-4" alt="Next" />
                </button>
                <button id="shuffle-btn" type="button"
                        class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                    <img src="public/icons/shuffle.svg" class="w-4 h-4" alt="Shuffle" />
                </button>
            </div>

            <div class="flex items-center space-x-2 w-full text-[11px] md:text-xs">
                <span id="current-time" class="min-w-[38px] text-right">00:00</span>
                <input type="range" id="progress" value="0" min="0" max="100"
                       class="w-full h-1 accent-white/90 bg-white/20 rounded-full cursor-pointer">
                <span id="duration" class="min-w-[38px]">00:00</span>
            </div>
        </div>

        <!-- Volume -->
        <div class="flex items-center space-x-2">
            <button id="mute-btn" type="button"
                    class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                <img id="volume-icon" src="public/icons/sound-on.svg" class="w-4 h-4" alt="Volume" />
            </button>
            <input type="range" id="volume" min="0" max="1" step="0.01" value="1"
                   class="w-20 accent-white/90 bg-white/20 rounded-full cursor-pointer">
        </div>
    </div>
</div>

<!-- Mobile Mini Player -->
<div id="mobile-player"
     class="fixed bottom-16 inset-x-0 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]
            text-white py-2.5 px-3 z-50 shadow-[0_-6px_22px_rgba(0,0,0,0.4)]
            border-t border-white/10 md:hidden cursor-pointer hidden">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">

        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-xl overflow-hidden bg-white/10 border border-white/20">
                <img id="mobile-mini-cover" src="public/images/placeholder.jpg"
                     class="w-full h-full object-cover"
                     alt="Cover" />
            </div>
            <div class="min-w-0">
                <p id="mobile-song-title" class="font-semibold text-sm truncate">
                    Pilih lagu
                </p>
                <p id="mobile-song-artist" class="text-[11px] text-gray-200 truncate">
                    -
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button id="mobile-love-btn" type="button"
                    class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                <img src="public/icons/love.svg" class="w-5 h-5" alt="Love" />
            </button>
            <button id="mobile-play-btn" type="button"
                    class="p-2 rounded-full bg-white/5 hover:bg-white/15 transition">
                <img id="mobile-play-icon" src="public/icons/play.svg" class="w-6 h-6" alt="Play" />
            </button>
        </div>
    </div>
</div>

<!-- Mobile Detail Player (Full View) -->
<div id="mobile-detail-player"
     class="fixed inset-0 z-50 hidden flex flex-col md:hidden
            bg-gradient-to-b from-[#1C4E95] via-[#244F9B] to-white">

    <!-- HEADER - Glassmorphism -->
    <div class="backdrop-blur-md bg-white/15 flex items-center justify-between px-6 py-4 border-b border-white/15">

        <!-- Back -->
        <button id="detail-back-btn" type="button"
                class="w-10 h-10 flex items-center justify-center rounded-full bg-white/25 text-white
                       shadow-sm hover:bg-white/40 hover:scale-105 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <span class="text-white font-semibold text-lg tracking-wide drop-shadow">
            Now Playing
        </span>

        <!-- LOVE di header -->
        <button id="mobile-detail-love-btn" type="button"
                class="w-10 h-10 flex items-center justify-center rounded-full
                       bg-white/20 text-white backdrop-blur-sm
                       shadow-sm hover:bg-white/30 hover:scale-105 transition">
            <img id="mobile-detail-love-icon" src="public/icons/love.svg" class="w-5 h-5" alt="Love" />
        </button>
    </div>

    <!-- COVER ART -->
    <div class="mt-10 flex justify-center">
        <div class="w-64 h-64 rounded-[2rem] overflow-hidden
                    shadow-[0_14px_40px_rgba(0,0,0,0.35)] bg-white/5 border border-white/20">
            <img id="mobile-detail-cover" src="public/images/placeholder.jpg"
                 class="w-full h-full object-cover" />
        </div>
    </div>

    <!-- SONG INFO -->
    <div class="text-center mt-8 px-6">
        <h2 id="mobile-detail-title"
            class="text-2xl font-semibold text-white drop-shadow-sm">
            Pilih Lagu
        </h2>
        <p id="mobile-detail-artist" class="text-sm text-blue-100/80 mt-1">
            -
        </p>
    </div>

    <!-- PROGRESS BAR -->
    <div class="px-8 mt-8">
        <div class="relative">
            <input type="range" id="mobile-detail-progress" value="0" min="0" max="100"
                   class="w-full h-2 accent-[#F9FAFB] bg-white/25 rounded-full cursor-pointer" />
        </div>
        <div class="flex items-center justify-between text-[11px] text-blue-50 mt-1">
            <span id="mobile-detail-current">0:00</span>
            <span id="mobile-detail-duration">0:00</span>
        </div>
    </div>

    <!-- CONTROL BUTTONS -->
    <div class="flex items-center justify-between px-6 py-8 mt-4">

        <!-- Shuffle -->
        <button id="detail-shuffle-btn" type="button"
                class="w-14 h-14 flex items-center justify-center rounded-full
                       bg-[#1C4E95] text-white border-2 border-white/80
                       shadow-[0_10px_28px_rgba(12,53,140,0.75)]
                       hover:bg-[#184283] hover:shadow-[0_14px_34px_rgba(12,53,140,0.9)]
                       hover:scale-105 transition">
            <img src="public/icons/shuffle.svg" class="w-5 h-5" alt="Shuffle" />
        </button>

        <!-- Prev -->
        <button id="mobile-prev-btn" type="button"
                class="w-14 h-14 flex items-center justify-center rounded-full
                       bg-[#1C4E95] text-white border-2 border-white/80
                       shadow-[0_10px_28px_rgba(12,53,140,0.75)]
                       hover:bg-[#184283] hover:shadow-[0_14px_34px_rgba(12,53,140,0.9)]
                       hover:scale-105 transition">
            <img src="public/icons/prev.svg" class="w-6 h-6" alt="Previous" />
        </button>

        <!-- Play / Pause (utama) -->
        <button id="mobile-detail-play-btn" type="button"
                class="w-20 h-20 flex items-center justify-center rounded-full
                       bg-[#1C4E95] text-white border-2 border-white/80
                       shadow-[0_10px_28px_rgba(12,53,140,0.75)]
                       hover:bg-[#184283] hover:shadow-[0_14px_34px_rgba(12,53,140,0.9)]
                       hover:scale-105 transition">
            <img id="mobile-detail-play-icon" src="public/icons/play.svg" class="w-8 h-8" />
            <img id="mobile-detail-pause-icon" src="public/icons/pause.svg" class="w-8 h-8 hidden" />
        </button>

        <!-- Next -->
        <button id="mobile-next-btn" type="button"
                class="w-14 h-14 flex items-center justify-center rounded-full
                       bg-[#1C4E95] text-white border-2 border-white/80
                       shadow-[0_10px_28px_rgba(12,53,140,0.75)]
                       hover:bg-[#184283] hover:shadow-[0_14px_34px_rgba(12,53,140,0.9)]
                       hover:scale-105 transition">
            <img src="public/icons/next.svg" class="w-6 h-6" alt="Next" />
        </button>

        <!-- Repeat -->
        <button id="detail-repeat-btn" type="button"
                class="w-14 h-14 flex items-center justify-center rounded-full
                       bg-[#1C4E95] text-white border-2 border-white/80
                       shadow-[0_10px_28px_rgba(12,53,140,0.75)]
                       hover:bg-[#184283] hover:shadow-[0_14px_34px_rgba(12,53,140,0.9)]
                       hover:scale-105 transition">
            <img src="public/icons/repeat.svg" class="w-5 h-5" alt="Repeat" />
        </button>
    </div>
</div>

<!-- Audio -->
<audio id="audio-player"></audio>

<!-- 🔹 Modal global: login dulu sebelum pakai fitur favorit -->
<div id="login-required-modal"
     class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm sm:max-w-md p-6 sm:p-7 text-center">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-1">
            Login dulu, yuk! <span>🎧</span>
        </h2>

        <p class="text-xs sm:text-sm text-gray-600 mb-5 sm:mb-6 leading-relaxed">
            Untuk mengakses dan menyimpan playlist lagu favorit, kamu perlu login terlebih dahulu.
        </p>

        <div class="flex flex-col sm:flex-row sm:justify-center gap-2.5 sm:gap-3">
            {{-- Tombol utama: Login sekarang --}}
            <a id="login-modal-goto" href="{{ route('login') }}"
               class="flex-1 px-4 py-2.5 rounded-xl bg-[#1C4E95] text-white text-sm sm:text-[0.9rem]
                      font-semibold shadow hover:bg-[#163b70] transition-colors duration-150">
                Login sekarang
            </a>

            {{-- Tombol sekunder: Nanti saja --}}
            <button id="login-modal-cancel"
                    class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700
                           text-sm sm:text-[0.9rem] font-medium hover:bg-gray-50 transition-colors duration-150">
                Nanti saja
            </button>
        </div>
    </div>
</div>

<script>
    // Util
    const $ = (id) => document.getElementById(id);

    const audio = $("audio-player");
    let currentSongIndex = 0;
    let songs = [];
    let isShuffle = false;
    let isRepeat = false;
    let isLoved = false;

    // URL untuk fitur Lagu Favorit
    const laguFavoritToggleUrl = "{{ route('lagu-favorit.toggle') }}";
    const loginUrl = "{{ route('login') }}";
    const csrfToken = "{{ csrf_token() }}";
    const isPlaylistPage = "{{ request()->routeIs('playlist') ? '1' : '0' }}";

    // Modal login
    const loginModal = $("login-required-modal");
    const loginModalCancel = $("login-modal-cancel");
    const loginModalGoto = $("login-modal-goto");

    function openLoginModal() {
        if (!loginModal) {
            // fallback kalau modal tidak ketemu
            window.location.href = loginUrl;
            return;
        }
        loginModal.classList.remove("hidden");
        loginModal.classList.add("flex");
    }

    function closeLoginModal() {
        if (!loginModal) return;
        loginModal.classList.add("hidden");
        loginModal.classList.remove("flex");
    }

    // Desktop elements
    const playBtn = $("play-btn");
    const playIcon = $("play-icon");
    const prevBtn = $("prev-btn");
    const nextBtn = $("next-btn");
    const shuffleBtn = $("shuffle-btn");
    const repeatBtn = $("repeat-btn");
    const loveBtn = $("love-btn");
    const progress = $("progress");
    const currentTimeEl = $("current-time");
    const durationEl = $("duration");
    const volumeSlider = $("volume");
    const muteBtn = $("mute-btn");
    const volumeIcon = $("volume-icon");
    const songTitle = $("song-title");
    const songArtist = $("song-artist");
    const desktopCover = $("desktop-cover");

    // Mobile mini player
    const mobilePlayer = $("mobile-player");
    const mobilePlayBtn = $("mobile-play-btn");
    const mobilePlayIcon = $("mobile-play-icon");
    const mobileSongTitle = $("mobile-song-title");
    const mobileSongArtist = $("mobile-song-artist");
    const mobileMiniCover = $("mobile-mini-cover");
    const mobileLoveBtn = $("mobile-love-btn");

    // Mobile detail player
    const mobileDetail = $("mobile-detail-player");
    const detailBackBtn = $("detail-back-btn");
    const mobileDetailTitle = $("mobile-detail-title");
    const mobileDetailArtist = $("mobile-detail-artist");
    const mobileDetailPlayBtn = $("mobile-detail-play-btn");
    const mobileDetailPlayIcon = $("mobile-detail-play-icon");
    const mobileDetailPauseIcon = $("mobile-detail-pause-icon");
    const mobileDetailProgress = $("mobile-detail-progress");
    const mobileDetailCurrent = $("mobile-detail-current");
    const mobileDetailDuration = $("mobile-detail-duration");
    const detailShuffleBtn = $("detail-shuffle-btn");
    const detailRepeatBtn = $("detail-repeat-btn");
    const mobileDetailLoveBtn = $("mobile-detail-love-btn");
    const mobileDetailLoveIcon = $("mobile-detail-love-icon");

    // Format waktu mm:ss
    function formatTime(sec) {
        const minutes = Math.floor(sec / 60) || 0;
        const seconds = Math.floor(sec % 60) || 0;
        return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
    }

    // Update icon love (desktop, mini, dan header detail)
    function updateLoveIcon() {
        const loveSrc = isLoved ? "public/icons/love-filled.svg" : "public/icons/love.svg";

        if (loveBtn) {
            const img = loveBtn.querySelector("img");
            if (img) img.src = loveSrc;
        }

        if (mobileLoveBtn) {
            const img = mobileLoveBtn.querySelector("img");
            if (img) img.src = loveSrc;
        }

        if (mobileDetailLoveBtn) {
            const img = mobileDetailLoveBtn.querySelector("img");
            if (img) img.src = loveSrc;
        }
    }

    // Sync isLoved dari .song-item aktif
    function syncLoveFromCurrentSong() {
        const current = songs[currentSongIndex];
        if (!current) {
            isLoved = false;
        } else {
            isLoved = current.getAttribute("data-favorite") === "1";
        }
        updateLoveIcon();
    }

    // Toggle Play/Pause
    function togglePlay() {
        if (!audio.src) return;
        if (audio.paused) {
            audio.play();
            if (playIcon) playIcon.src = "public/icons/pause.svg";
            if (mobilePlayIcon) mobilePlayIcon.src = "public/icons/pause.svg";
            if (mobileDetailPlayIcon) mobileDetailPlayIcon.classList.add("hidden");
            if (mobileDetailPauseIcon) mobileDetailPauseIcon.classList.remove("hidden");
        } else {
            audio.pause();
            if (playIcon) playIcon.src = "public/icons/play.svg";
            if (mobilePlayIcon) mobilePlayIcon.src = "public/icons/play.svg";
            if (mobileDetailPlayIcon) mobileDetailPlayIcon.classList.remove("hidden");
            if (mobileDetailPauseIcon) mobileDetailPauseIcon.classList.add("hidden");
        }
    }

    // Toggle Repeat
    function toggleRepeat() {
        isRepeat = !isRepeat;
        if (repeatBtn) repeatBtn.classList.toggle("bg-white/20", isRepeat);
        if (detailRepeatBtn) detailRepeatBtn.classList.toggle("bg-blue-100", isRepeat);
    }

    // Toggle Shuffle UI
    function toggleShuffleUI(active) {
        shuffleBtn?.classList.toggle("bg-white/20", active);
        detailShuffleBtn?.classList.toggle("bg-blue-100", active);
    }

    // Toggle Love + kirim ke backend LaguFavorit
    function toggleLove() {
        if (!songs || songs.length === 0) {
            alert("Pilih lagu dulu sebelum menandai favorit.");
            return;
        }

        const current = songs[currentSongIndex];
        if (!current) {
            alert("Pilih lagu dulu sebelum menandai favorit.");
            return;
        }

        const karyaId = current.getAttribute("data-karya-id");
        if (!karyaId) {
            console.error("data-karya-id tidak ditemukan pada .song-item");
            alert("Terjadi kesalahan: ID lagu tidak ditemukan.");
            return;
        }

        const body = new URLSearchParams();
        body.append("karya_id", karyaId);

        fetch(laguFavoritToggleUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                    "X-CSRF-TOKEN": csrfToken,
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json",
                },
                body: body.toString(),
            })
            .then(async (res) => {
                if (res.status === 401) {
                    // 🔹 Tampilkan popup login
                    openLoginModal();
                    return null;
                }

                if (res.status === 419) {
                    alert("Sesi kamu sudah habis. Halaman akan dimuat ulang.");
                    window.location.reload();
                    return null;
                }

                if (!res.ok) {
                    const text = await res.text();
                    console.error("Gagal toggle favorit. Status:", res.status, text);
                    alert("Terjadi kesalahan saat menyimpan lagu favorit.");
                    return null;
                }

                return res.json();
            })
            .then((data) => {
                if (!data || !data.success) return;

                isLoved = !!data.is_favorite;

                // update attribute DOM
                current.setAttribute("data-favorite", isLoved ? "1" : "0");

                // update icon
                updateLoveIcon();

                // Jika di halaman /playlist dan user meng-unlove, hapus baris dari daftar
                if (!isLoved && isPlaylistPage === "1") {
                    current.remove();
                }
            })
            .catch((err) => {
                console.error("Error fetch lagu-favorit/toggle:", err);
                alert("Terjadi kesalahan jaringan saat menyimpan lagu favorit.");
            });
    }

    // Load Lagu Baru dan update UI
    function loadSong(title, artist, src, cover = "public/images/placeholder.jpg", index = 0) {
        if (songTitle) songTitle.textContent = title;
        if (songArtist) songArtist.textContent = artist;
        if (mobileSongTitle) mobileSongTitle.textContent = title;
        if (mobileSongArtist) mobileSongArtist.textContent = artist;
        if (mobileDetailTitle) mobileDetailTitle.textContent = title;
        if (mobileDetailArtist) mobileDetailArtist.textContent = artist;

        const coverEl = $("mobile-detail-cover");
        if (coverEl) coverEl.src = cover;
        if (desktopCover) desktopCover.src = cover;
        if (mobileMiniCover) mobileMiniCover.src = cover;

        audio.src = src;
        currentSongIndex = index;

        // Tampilkan player hanya setelah ada lagu
        const desktopPlayerEl = $("desktop-player");
        if (desktopPlayerEl) {
            desktopPlayerEl.classList.remove("hidden");
            desktopPlayerEl.classList.add("md:block");
        }
        if (mobilePlayer) {
            mobilePlayer.classList.remove("hidden");
        }

        // sync love state dari item
        syncLoveFromCurrentSong();

        // Play setelah user memilih lagu
        audio.play();
        if (playIcon) playIcon.src = "public/icons/pause.svg";
        if (mobilePlayIcon) mobilePlayIcon.src = "public/icons/pause.svg";
        if (mobileDetailPlayIcon && mobileDetailPauseIcon) {
            mobileDetailPlayIcon.classList.add("hidden");
            mobileDetailPauseIcon.classList.remove("hidden");
        }

        // highlight active song
        songs.forEach(el => el.classList.remove("bg-gray-100"));
        if (songs[index]) songs[index].classList.add("bg-gray-100");
    }

    // Initialize playlist
    function initPlaylist() {
        songs = Array.from(document.querySelectorAll(".song-item"));
        songs.forEach((item, index) => {
            item.addEventListener("click", () => {
                const src = item.getAttribute("data-src");
                const title = item.getAttribute("data-title");
                const artist = item.getAttribute("data-artist");
                const cover = item.getAttribute("data-cover") || "public/images/placeholder.jpg";
                if (!src) return;
                loadSong(title, artist, src, cover, index);
            });
        });
    }

    // Prev / Next
    function playPrev() {
        if (songs.length === 0) return;
        currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
        songs[currentSongIndex].click();
    }

    function playNext() {
        if (songs.length === 0) return;
        if (isShuffle) {
            let nextIndex;
            do {
                nextIndex = Math.floor(Math.random() * songs.length);
            } while (nextIndex === currentSongIndex && songs.length > 1);
            currentSongIndex = nextIndex;
        } else {
            currentSongIndex = (currentSongIndex + 1) % songs.length;
        }
        songs[currentSongIndex].click();
    }

    // Event bindings
    prevBtn?.addEventListener("click", playPrev);
    nextBtn?.addEventListener("click", playNext);
    $("mobile-prev-btn")?.addEventListener("click", playPrev);
    $("mobile-next-btn")?.addEventListener("click", playNext);

    playBtn?.addEventListener("click", togglePlay);
    mobilePlayBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        togglePlay();
    });
    mobileDetailPlayBtn?.addEventListener("click", togglePlay);

    loveBtn?.addEventListener("click", toggleLove);
    mobileLoveBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleLove();
    });
    mobileDetailLoveBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleLove();
    });

    repeatBtn?.addEventListener("click", toggleRepeat);
    detailRepeatBtn?.addEventListener("click", toggleRepeat);

    shuffleBtn?.addEventListener("click", () => {
        isShuffle = !isShuffle;
        toggleShuffleUI(isShuffle);
    });
    detailShuffleBtn?.addEventListener("click", () => {
        isShuffle = !isShuffle;
        toggleShuffleUI(isShuffle);
    });

    // Open/Close detail player
    mobilePlayer?.addEventListener("click", () => {
        mobileDetail?.classList.remove("hidden");
    });
    detailBackBtn?.addEventListener("click", () => {
        mobileDetail?.classList.add("hidden");
    });

    // Modal events
    loginModalCancel?.addEventListener("click", () => {
        closeLoginModal();
    });
    loginModal?.addEventListener("click", (e) => {
        if (e.target === loginModal) {
            closeLoginModal();
        }
    });

    // Metadata loaded
    audio.addEventListener("loadedmetadata", () => {
        const duration = audio.duration || 0;
        if (progress) progress.max = duration;
        if (mobileDetailProgress) mobileDetailProgress.max = duration;
        if (durationEl) durationEl.textContent = formatTime(duration);
        if (mobileDetailDuration) mobileDetailDuration.textContent = formatTime(duration);
    });

    // Update progress
    audio.addEventListener("timeupdate", () => {
        const current = audio.currentTime || 0;
        if (progress) progress.value = current;
        if (mobileDetailProgress) mobileDetailProgress.value = current;
        if (currentTimeEl) currentTimeEl.textContent = formatTime(current);
        if (mobileDetailCurrent) mobileDetailCurrent.textContent = formatTime(current);
    });

    // Seek
    progress?.addEventListener("input", () => {
        audio.currentTime = parseFloat(progress.value);
    });
    mobileDetailProgress?.addEventListener("input", () => {
        audio.currentTime = parseFloat(mobileDetailProgress.value);
    });

    // Volume & mute
    volumeSlider?.addEventListener("input", () => {
        audio.volume = volumeSlider.value;
        if (volumeIcon) volumeIcon.src = audio.volume == 0 ? "public/icons/sound-off.svg" : "public/icons/sound-on.svg";
    });
    muteBtn?.addEventListener("click", () => {
        if (audio.volume > 0) {
            audio.volume = 0;
            if (volumeSlider) volumeSlider.value = 0;
            if (volumeIcon) volumeIcon.src = "public/icons/sound-off.svg";
        } else {
            audio.volume = 1;
            if (volumeSlider) volumeSlider.value = 1;
            if (volumeIcon) volumeIcon.src = "public/icons/sound-on.svg";
        }
    });

    // Auto Next
    audio.addEventListener("ended", () => {
        if (isRepeat) {
            songs[currentSongIndex]?.click();
        } else {
            playNext();
        }
    });

    // Init tanpa autoplay
    window.addEventListener("DOMContentLoaded", () => {
        initPlaylist();
    });
</script>
