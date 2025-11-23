@extends('layouts.layout')

@section('content')
<div
    class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 via-gray-100 to-blue-200 py-6 px-4">
    <div
        class="max-w-6xl w-full bg-white rounded-2xl shadow-lg overflow-hidden
               grid grid-cols-1 md:grid-cols-2 transition-all duration-500
               min-h-[520px] md:min-h-[560px]">

        {{-- BAGIAN GAMBAR --}}
        <div class="relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80"
                 alt="Concert" class="w-full h-full object-cover">
            <div
                class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center text-white px-8">
                <h2 class="text-3xl font-bold mb-3">Reset Password Akunmu</h2>
                <p class="text-sm max-w-sm">
                    Masukkan email yang terdaftar di Sumber Suara dan kami akan mengirimkan link untuk mengatur ulang password.
                </p>
            </div>
        </div>

        {{-- BAGIAN FORM --}}
        <div class="p-10 md:p-12 flex flex-col justify-center">

            {{-- Logo / Judul --}}
            <div class="mb-4 text-center">
                <h1 class="text-3xl font-bold text-[#1C4E95]">Sumber Suara</h1>
                <p class="text-gray-600 mt-2 text-sm">Lupa password? Atur ulang di sini</p>
            </div>

            {{-- NOTIF STATUS (link terkirim) --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-xs">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM LUPA PASSWORD --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                        Email yang terdaftar
                    </label>
                    <input id="email" name="email" type="email" placeholder="Email"
                           value="{{ old('email') }}"
                           class="w-full px-5 py-3 border border-gray-300 rounded-lg
                                  focus:outline-none focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]
                                  placeholder:text-gray-400 transition"
                           required>
                </div>

                <button type="submit"
                        class="w-full py-3 bg-[#1C4E95] text-white rounded-lg font-semibold
                               hover:bg-blue-900 transition transform hover:scale-[1.02] active:scale-95
                               shadow-md hover:shadow-lg">
                    Kirim Link Reset Password
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-gray-600">
                Kembali ke halaman
                <a href="{{ route('login') }}" class="text-[#1C4E95] font-semibold hover:underline">
                    Login
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
