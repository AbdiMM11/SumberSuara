@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12 relative overflow-hidden">

            <!-- Background dekoratif -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-50 via-gray-50 to-blue-100 opacity-40 pointer-events-none">
            </div>

            <!-- Judul -->
            <div class="relative z-10 text-center mb-10">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1C4E95]">
                    Tentang Komunitas
                </h2>
                <p class="mt-2 text-gray-600 text-sm sm:text-base">
                    Mengenal lebih dekat Komunitas <span class="font-semibold">Sumber Suara</span>
                </p>
            </div>

            <!-- Konten -->
            <div class="relative z-10 space-y-10 text-gray-700 leading-relaxed">
                <!-- Bagian 1 -->
                <div class="group">
                    <div class="flex items-center gap-3 mb-3">
                        <!-- Ikon -->
                        <div
                            class="flex-shrink-0 bg-[#1C4E95] text-white w-8 h-8 sm:w-14 sm:h-14 flex items-center justify-center rounded-full shadow-md group-hover:scale-105 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 sm:w-7 sm:h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0A9 9 0 113 12a9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <!-- Judul -->
                        <h3 class="text-base sm:text-xl font-bold text-gray-900">
                            Sejarah dan Latar Belakang
                        </h3>
                    </div>
                    <p class="text-sm sm:text-base text-justify">
                        Komunitas Sumber Suara lahir dari keresahan para pelaku musik lokal di Lampung terhadap minimnya
                        ruang apresiasi, promosi, dan kolaborasi bagi musisi independen. Didirikan sebagai wadah kolektif,
                        Sumber Suara hadir untuk mempertemukan musisi, komunitas kreatif, dan penikmat musik dalam satu
                        ekosistem yang saling mendukung. Seiring waktu, komunitas ini berkembang menjadi ruang aktif yang
                        mendorong pertumbuhan musik lokal melalui event, showcase, dan kolaborasi lintas komunitas.
                    </p>
                </div>

                <!-- Bagian 2 -->
                <div class="group">
                    <div class="flex items-center gap-3 mb-3">
                        <!-- Ikon -->
                        <div
                            class="flex-shrink-0 bg-[#1C4E95] text-white w-8 h-8 sm:w-14 sm:h-14 flex items-center justify-center rounded-full shadow-md group-hover:scale-105 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 sm:w-7 sm:h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-3A2.25 2.25 0 008.25 5.25V9m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3A2.25 2.25 0 008.25 5.25V9m7.5 0h-7.5m7.5 0V19.5A2.25 2.25 0 0113.5 21h-3A2.25 2.25 0 018.25 19.5V9" />
                            </svg>
                        </div>
                        <!-- Judul -->
                        <h3 class="text-base sm:text-xl font-bold text-gray-900">
                            Visi dan Misi
                        </h3>
                    </div>
                    <p class="text-sm sm:text-base text-justify">
                        Visi Sumber Suara adalah menjadi ruang utama pengembangan dan promosi musik lokal Lampung yang
                        inklusif,
                        kreatif, dan berkelanjutan. Untuk mewujudkan visi tersebut, komunitas ini memiliki misi: mewadahi
                        musisi lokal
                        agar dapat berkarya dan mendapatkan panggung apresiasi, mendorong kolaborasi antar komunitas
                        kreatif,
                        mengembangkan budaya saling dukung dalam ekosistem musik independen, serta menyediakan ruang
                        edukasi, promosi,
                        dan distribusi karya musik lokal.
                    </p>
                </div>

                <!-- Bagian 3 -->
                <div class="group">
                    <div class="flex items-center gap-3 mb-3">
                        <!-- Ikon -->
                        <div
                            class="flex-shrink-0 bg-[#1C4E95] text-white w-8 h-8 sm:w-14 sm:h-14 flex items-center justify-center rounded-full shadow-md group-hover:scale-105 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 sm:w-7 sm:h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <!-- Judul -->
                        <h3 class="text-base sm:text-xl font-bold text-gray-900">
                            Program dan Aktivitas
                        </h3>
                    </div>
                    <p class="text-sm sm:text-base text-justify">
                        Sumber Suara secara aktif menyelenggarakan berbagai program seperti showcase dan gigs musik yang
                        menghadirkan
                        band serta musisi lokal, program roadshow bertema seperti AKDP (Antar Kota Dalam Provinsi) di
                        berbagai titik
                        Lampung, kolaborasi dengan komunitas kreatif dan venue lokal, promosi digital melalui media sosial,
                        serta ruang
                        diskusi dan sharing seputar produksi karya, manajemen musisi, dan perkembangan ekosistem musik
                        independen di
                        Lampung.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
