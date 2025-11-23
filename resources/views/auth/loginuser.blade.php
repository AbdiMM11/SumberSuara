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
                <h2 class="text-3xl font-bold mb-3">Selamat Datang Kembali!</h2>
                <p class="text-sm max-w-sm">
                    Masuk untuk menemukan musisi lokal Lampung dan lanjutkan aktivitasmu di Sumber Suara.
                </p>
            </div>
        </div>

        {{-- BAGIAN FORM --}}
        <div class="p-10 md:p-12 flex flex-col justify-center">

            {{-- Logo / Judul --}}
            <div class="mb-4 text-center">
                <h1 class="text-3xl font-bold text-[#1C4E95]">Sumber Suara</h1>
                <p class="text-gray-600 mt-2 text-sm">Masuk untuk melanjutkan ke akunmu</p>
            </div>

            {{-- FLASH MESSAGE: success --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-xs border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FLASH MESSAGE: warning --}}
            @if (session('warning'))
                <div class="mb-4 p-3 rounded-lg bg-amber-50 text-amber-800 text-xs border border-amber-200">
                    {{ session('warning') }}
                </div>
            @endif

            {{-- FLASH MESSAGE: password reset / email sent --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-xs border border-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ERROR GLOBAL (email/password salah, akun nonaktif, akun pending, dll.) --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-xs border border-red-200">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- TAB LOGIN / SIGN UP --}}
            <div class="mb-6">
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button type="button"
                        class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                               bg-[#1C4E95] text-white shadow-md
                               hover:bg-blue-900 hover:shadow-lg hover:scale-[1.02]
                               transition-all duration-200">
                        Login
                    </button>

                    <button type="button"
                        onclick="openRegisterPopup()"
                        class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                               text-gray-600 hover:text-[#1C4E95] hover:bg-white
                               transition-all duration-200">
                        Sign Up
                    </button>
                </div>
            </div>

            {{-- FORM LOGIN --}}
            <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Email"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                               placeholder:text-gray-400 transition"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1" for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                               placeholder:text-gray-400 transition"
                        required>
                    @error('password')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Forgot Password --}}
                <div class="flex items-center justify-between text-xs md:text-sm">
                    <span></span>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-gray-700 hover:text-[#1C4E95] hover:underline">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Tombol Login --}}
                <button type="submit"
                    class="w-full py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                           hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                           shadow-md hover:shadow-lg">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-gray-600">
                Belum punya akun? Klik tombol <span class="font-semibold">Sign Up</span> di atas untuk memilih daftar sebagai Musisi atau Audiens.
            </p>
        </div>
    </div>
</div>

{{-- POPUP REGISTRASI --}}
@include('components.popup-registrasi')

@endsection
