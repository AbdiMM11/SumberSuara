@extends('layouts.layout')

@section('content')
    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 via-gray-100 to-blue-200 py-6 px-4">
        <div
            class="max-w-6xl w-full bg-white rounded-2xl shadow-lg overflow-hidden
                grid grid-cols-1 md:grid-cols-2 transition-all duration-500
                min-h-[620px] md:min-h-[680px]">

            {{-- BAGIAN GAMBAR --}}
            <div class="relative hidden md:block">
                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80"
                    alt="Concert" class="w-full h-full object-cover">
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center text-white px-8">
                    <h2 class="text-3xl font-bold mb-3">Gabung Sebagai Musisi</h2>
                    <p class="text-sm max-w-sm">
                        Promosikan karya originalmu, terhubung dengan audience dan komunitas musik lokal Lampung melalui
                        Sumber Suara.
                    </p>
                </div>
            </div>

            {{-- BAGIAN FORM --}}
            <div class="p-10 md:p-12 flex flex-col justify-center">
                {{-- Logo / Judul --}}
                <div class="mb-4 text-center">
                    <h1 class="text-3xl font-bold text-[#1C4E95]">Sumber Suara</h1>
                    <p class="text-gray-600 mt-2 text-sm">Daftar sebagai musisi untuk melanjutkan</p>
                </div>

                {{-- FLASH MESSAGE (kalau nanti ada) --}}
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-xs text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="mb-4 rounded-lg bg-amber-50 border border-amber-200 px-4 py-3 text-xs text-amber-800">
                        {{ session('warning') }}
                    </div>
                @endif

                {{-- TAB LOGIN / SIGN UP --}}
                <div class="mb-4">
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <a href="{{ route('login') }}"
                            class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                              text-gray-600 hover:text-[#1C4E95] hover:bg-white
                              transition-all duration-200">
                            Login
                        </a>
                        <button type="button"
                            class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                                   bg-[#1C4E95] text-white shadow-md
                                   hover:bg-blue-900 hover:shadow-lg hover:scale-[1.02]
                                   transition-all duration-200">
                            Sign Up
                        </button>
                    </div>
                </div>

                {{-- ERROR VALIDATION GLOBAL --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- INDICATOR STEP --}}
                <div class="flex items-center justify-between mb-4 text-xs font-semibold text-gray-500">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-[#1C4E95] text-white step-dot"
                            data-dot="1">1</div>
                        <span>Data Akun</span>
                    </div>
                    <div class="flex-1 border-t border-gray-200 mx-2"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 step-dot"
                            data-dot="2">2</div>
                        <span>Profil Band</span>
                    </div>
                    <div class="flex-1 border-t border-gray-200 mx-2"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 step-dot"
                            data-dot="3">3</div>
                        <span>Sosial Media</span>
                    </div>
                </div>

                {{-- FORM MULTI STEP --}}
                <form id="formRegisterMusisi"
                      action="{{ route('signup.musisi') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-4">
                    @csrf

                    {{-- STEP 1: DATA AKUN --}}
                    <div class="space-y-4 step-pane" data-step="1">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                                Email
                            </label>
                            <input id="email" name="email" type="email" placeholder="Email"
                                value="{{ old('email') }}"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                      focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                      placeholder:text-gray-400 transition"
                                required>
                            @error('email')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No. Handphone --}}
                        <div>
                            <label for="no_hp" class="block text-xs font-semibold text-gray-700 mb-1">
                                No. Handphone
                            </label>
                            <input id="no_hp" name="no_hp" type="text" placeholder="08xxxxxxxxxx"
                                value="{{ old('no_hp') }}"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                      focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                      placeholder:text-gray-400 transition"
                                required>
                            @error('no_hp')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
                                Password
                            </label>
                            <input id="password" name="password" type="password" placeholder="Password"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                      focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                      placeholder:text-gray-400 transition"
                                required>
                            @error('password')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="Ulangi password"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                      focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                      placeholder:text-gray-400 transition"
                                required>
                        </div>

                        <div class="pt-2">
                            <button type="button"
                                class="w-full py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                                       hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                                       shadow-md hover:shadow-lg"
                                data-next>
                                Next
                            </button>
                        </div>
                    </div>

                    {{-- STEP 2: PROFIL BAND --}}
                    <div class="space-y-4 step-pane hidden" data-step="2">
                        {{-- Nama Band / Musisi --}}
                        <div>
                            <label for="nama_band" class="block text-xs font-semibold text-gray-700 mb-1">
                                Nama Band / Musisi
                            </label>
                            <input id="nama_band" name="nama_band" type="text" placeholder="Nama band atau nama panggung"
                                value="{{ old('nama_band') }}"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                      focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                      placeholder:text-gray-400 transition"
                                required>
                            @error('nama_band')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Genre --}}
                        <div>
                            <label for="genre" class="block text-xs font-semibold text-gray-700 mb-1">
                                Genre
                            </label>
                            <div class="relative">
                                <select id="genre" name="genre"
                                    class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                           focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                           bg-white appearance-none transition"
                                    required>
                                    <option value="" disabled {{ old('genre') ? '' : 'selected' }}>Pilih genre</option>
                                    <option value="Pop" {{ old('genre') === 'Pop' ? 'selected' : '' }}>Pop</option>
                                    <option value="Rock" {{ old('genre') === 'Rock' ? 'selected' : '' }}>Rock</option>
                                    <option value="Jazz" {{ old('genre') === 'Jazz' ? 'selected' : '' }}>Jazz</option>
                                    <option value="Blues" {{ old('genre') === 'Blues' ? 'selected' : '' }}>Blues</option>
                                    <option value="Metal" {{ old('genre') === 'Metal' ? 'selected' : '' }}>Metal</option>
                                    <option value="Reggae/SKA" {{ old('genre') === 'Reggae/SKA' ? 'selected' : '' }}>Reggae / SKA</option>
                                    <option value="Hip Hop" {{ old('genre') === 'Hip Hop' ? 'selected' : '' }}>Hip Hop</option>
                                    <option value="Other" {{ old('genre') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 011.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                            @error('genre')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Domisili --}}
                        <div>
                            <label for="domisili" class="block text-xs font-semibold text-gray-700 mb-1">
                                Domisili
                            </label>
                            <div class="relative">
                                <select id="domisili" name="domisili"
                                    class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                           focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                           bg-white appearance-none transition"
                                           required>
                                    <option value="" disabled {{ old('domisili') ? '' : 'selected' }}>Pilih domisili</option>
                                    <option value="Bandar Lampung" {{ old('domisili') === 'Bandar Lampung' ? 'selected' : '' }}>Bandar Lampung</option>
                                    <option value="Metro" {{ old('domisili') === 'Metro' ? 'selected' : '' }}>Metro</option>
                                    <option value="Lampung Selatan" {{ old('domisili') === 'Lampung Selatan' ? 'selected' : '' }}>Lampung Selatan</option>
                                    <option value="Lampung Tengah" {{ old('domisili') === 'Lampung Tengah' ? 'selected' : '' }}>Lampung Tengah</option>
                                    <option value="Lampung Timur" {{ old('domisili') === 'Lampung Timur' ? 'selected' : '' }}>Lampung Timur</option>
                                    <option value="Lampung Barat" {{ old('domisili') === 'Lampung Barat' ? 'selected' : '' }}>Lampung Barat</option>
                                    <option value="Lampung Utara" {{ old('domisili') === 'Lampung Utara' ? 'selected' : '' }}>Lampung Utara</option>
                                    <option value="Pesawaran" {{ old('domisili') === 'Pesawaran' ? 'selected' : '' }}>Pesawaran</option>
                                    <option value="Mesuji" {{ old('domisili') === 'Mesuji' ? 'selected' : '' }}>Mesuji</option>
                                    <option value="Pesisir Barat" {{ old('domisili') === 'Pesisir Barat' ? 'selected' : '' }}>Pesisir Barat</option>
                                    <option value="Pringsewu" {{ old('domisili') === 'Pringsewu' ? 'selected' : '' }}>Pringsewu</option>
                                    <option value="Tanggamus" {{ old('domisili') === 'Tanggamus' ? 'selected' : '' }}>Tanggamus</option>
                                    <option value="Tulang Bawang" {{ old('domisili') === 'Tulang Bawang' ? 'selected' : '' }}>Tulang Bawang</option>
                                    <option value="Tulang Bawang Barat" {{ old('domisili') === 'Tulang Bawang Barat' ? 'selected' : '' }}>Tulang Bawang Barat</option>
                                    <option value="Way Kanan" {{ old('domisili') === 'Way Kanan' ? 'selected' : '' }}>Way Kanan</option>
                                </select>
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 011.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                            @error('domisili')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload Lagu Original --}}
                        <div>
                            <label for="file_mp3" class="block text-xs font-semibold text-gray-700 mb-1">
                                Upload Lagu Original (MP3/OGG/WAV)
                            </label>
                            <div
                                class="flex items-center justify-between px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                                <div class="text-xs text-gray-600">
                                    <p class="font-semibold">Pilih file audio</p>
                                    <p class="text-[11px] text-gray-500">Format: .mp3 / .ogg / .wav • Maks. 20MB</p>
                                </div>
                                <label
                                    class="cursor-pointer inline-flex items-center px-3 py-2 text-xs font-semibold rounded-lg bg-[#1C4E95] text-white hover:bg-blue-900 transition">
                                    Browse
                                    <input id="file_mp3" name="file_mp3" type="file" class="hidden"
                                        accept=".mp3,.ogg,.wav,audio/*" required>
                                </label>
                            </div>
                            @error('file_mp3')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2 flex gap-3">
                            <button type="button"
                                class="w-1/2 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold
                                       hover:bg-gray-300 transition"
                                data-prev>
                                Back
                            </button>
                            <button type="button"
                                class="w-1/2 py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                                       hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                                       shadow-md hover:shadow-lg"
                                data-next>
                                Next
                            </button>
                        </div>
                    </div>

                    {{-- STEP 3: SOSIAL MEDIA --}}
                    <div class="space-y-4 step-pane hidden" data-step="3">

                        {{-- Spotify Username --}}
                        <div>
                            <label for="spotify" class="block text-xs font-semibold text-gray-700 mb-1">
                                Username Spotify
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute inset-y-0 left-4 flex items-center text-gray-400 text-sm">spotify.com/</span>
                                <input id="spotify" name="spotify" type="text" placeholder="username"
                                    value="{{ old('spotify') }}"
                                    class="w-full pl-32 px-5 py-3 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                          placeholder:text-gray-400 transition">
                            </div>
                        </div>

                        {{-- Instagram Username --}}
                        <div>
                            <label for="instagram" class="block text-xs font-semibold text-gray-700 mb-1">
                                Username Instagram
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 text-sm">@</span>
                                <input id="instagram" name="instagram" type="text" placeholder="username"
                                    value="{{ old('instagram') }}"
                                    class="w-full pl-10 px-5 py-3 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                          placeholder:text-gray-400 transition">
                            </div>
                        </div>

                        {{-- YouTube Username (Opsional) --}}
                        <div>
                            <label for="youtube" class="block text-xs font-semibold text-gray-700 mb-1">
                                Username Youtube (Opsional)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 text-sm">@</span>
                                <input id="youtube" name="youtube" type="text" placeholder="username"
                                    value="{{ old('youtube') }}"
                                    class="w-full pl-10 px-5 py-3 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                          placeholder:text-gray-400 transition">
                            </div>
                        </div>

                        <div class="pt-2 flex gap-3">
                            <button type="button"
                                class="w-1/2 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold
                       hover:bg-gray-300 transition"
                                data-prev>
                                Back
                            </button>
                            <button type="submit"
                                class="w-1/2 py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                       hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                       shadow-md hover:shadow-lg">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

                <p class="mt-6 text-center text-xs text-gray-600">
                    Data yang kamu isi akan dikirim ke Admin untuk diverifikasi. Akun musisi akan aktif setelah proses
                    verifikasi selesai.
                </p>
            </div>
        </div>
    </div>

    {{-- SCRIPT MULTI-STEP SEDERHANA --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const panes = document.querySelectorAll('.step-pane');
            const dots = document.querySelectorAll('.step-dot');

            function showStep(step) {
                currentStep = step;
                panes.forEach(p => {
                    p.classList.toggle('hidden', parseInt(p.dataset.step) !== step);
                });
                dots.forEach(d => {
                    const active = parseInt(d.dataset.dot) <= step;
                    d.classList.toggle('bg-[#1C4E95]', active);
                    d.classList.toggle('text-white', active);
                    d.classList.toggle('bg-gray-300', !active);
                    d.classList.toggle('text-gray-700', !active);
                });
            }

            document.querySelectorAll('[data-next]').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (currentStep < 3) showStep(currentStep + 1);
                });
            });

            document.querySelectorAll('[data-prev]').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (currentStep > 1) showStep(currentStep - 1);
                });
            });

            showStep(1);
        });
    </script>
@endsection
