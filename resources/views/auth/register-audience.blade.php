@extends('layouts.layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 via-gray-100 to-blue-200 py-6 px-4">
    <div class="max-w-6xl w-full bg-white rounded-2xl shadow-lg overflow-hidden
                grid grid-cols-1 md:grid-cols-2 transition-all duration-500
                min-h-[620px] md:min-h-[680px]">

        {{-- BAGIAN GAMBAR --}}
        <div class="relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80"
                 alt="Concert"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center text-white px-8">
                <h2 class="text-3xl font-bold mb-3">Gabung Sebagai Audience</h2>
                <p class="text-sm max-w-sm">
                    Nikmati rilisan terbaru, event seru, dan dukung musisi lokal Lampung melalui Sumber Suara.
                </p>
            </div>
        </div>

        {{-- BAGIAN FORM --}}
        <div class="p-10 md:p-12 flex flex-col justify-center">
            {{-- Logo / Judul --}}
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-[#1C4E95]">Sumber Suara</h1>
                <p class="text-gray-600 mt-2 text-sm">Daftar sebagai audience untuk melanjutkan</p>
            </div>

            {{-- FLASH MESSAGE (kalau suatu saat redirect ke sini dengan pesan) --}}
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
            <div class="mb-6">
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

            {{-- FORM SIGN UP --}}
            <form action="{{ route('signup.audience') }}" method="POST" class="space-y-4">
                @csrf

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

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="gender" class="block text-xs font-semibold text-gray-700 mb-1">
                        Jenis Kelamin
                    </label>
                    <div class="relative">
                        <select id="gender" name="gender"
                                class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                       focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                       bg-white appearance-none transition"
                                required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih jenis kelamin</option>
                            <option value="laki-laki" {{ old('gender') === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('gender') === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 011.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    @error('gender')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Umur --}}
                <div>
                    <label for="age" class="block text-xs font-semibold text-gray-700 mb-1">
                        Umur
                    </label>
                    <input id="age" name="age" type="number" min="10" max="120" placeholder="Umur"
                           value="{{ old('age') }}"
                           class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                  focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                  placeholder:text-gray-400 transition"
                           required>
                    @error('age')
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
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi password"
                           class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                  focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                  placeholder:text-gray-400 transition"
                           required>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                               hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                               shadow-md hover:shadow-lg">
                    Submit
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-gray-600">
                Dengan mendaftar, kamu menyetujui ketentuan layanan & kebijakan privasi Sumber Suara.
            </p>
        </div>
    </div>
</div>
@endsection
