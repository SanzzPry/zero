@extends('layouts.res')
@section('title', 'sign-in')
@section('main')
    <div class="min-h-screen flex">
        <!-- Bagian kiri (Info) -->
        <div class="w-1/2 relative hidden md:flex items-center justify-center bg-cover bg-center"
            style="background-image: url('/images/sign.jpg')">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 text-center text-white px-12">
                <h1 class="text-5xl font-bold mb-6">Halo Pengguna Area Kerja</h1>
                <p class="mb-16">untuk tetap terhubung dengan kami
                    <br> silakan masuk dengan informasi pribadi Anda
                </p>
                <a href="{{ route('auth.register')}}"
                    class="px-18 py-4 border border-white rounded-full hover:bg-white hover:text-black transition">
                    DAFTAR
                </a>
            </div>
        </div>
        <!-- Bagian kanan (Form) -->
        <div class="w-1/2 flex flex-col justify-center px-12">
            <!-- Logo -->
            <div class="absolute top-6 left-12 flex items-center">
                <img src="/images/Logo-area_kerja-white.png" alt="Logo" class="h-8 mt-2">
                <span class="text-lg font-bold text-white ml-2">areakerja.com</span>
            </div>


            <!-- Judul -->
            <h2 class="text-2xl font-bold text-center mb-6">Masuk</h2>

            <!-- Social Login -->
            <div class="flex justify-center space-x-4 mb-6">
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">G</button>
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">f</button>
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">in</button>
            </div>

            <!-- Form -->
            <form action="{{ route('login')}}" method="POST" class="space-y-2 w-120 mx-auto">
                @csrf @method('POST')
                {{-- <div>
                                                                                                                <label class="block text-sm font-medium pb-2">Nama Pengguna</label>
                                                                                                                <input type="text" name="username" placeholder="Nama Pengguna"
                                                                                                                    class="w-full border rounded-lg px-6 py-4">
                                                                                                            </div> --}}
                <div>
                    <label class="block text-sm font-medium pb-2">E-mail</label>
                    <input type="email" name="email" placeholder="E-mail" class="w-full border rounded-lg px-6 py-4">
                </div>
                {{-- <div>
                                                                                                                    <label class="block text-sm font-medium pb-2">No. Tlp</label>
                                                                                                                    <input type="text" name="phone" placeholder="No. Tlp" class="w-full border rounded-lg px-6 py-4">
                                                                                                                </div> --}}
                <div>
                    <label class="block text-sm font-medium pb-2">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="Kata Sandi"
                            class="w-full border rounded-lg px-6 py-4 pr-12" aria-describedby="togglePassword" />

                        <!-- Tombol toggle (position absolute) -->
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            aria-label="Tampilkan kata sandi" title="Tampilkan kata sandi">
                            <!-- Eye (visible) -->
                            <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 block" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- Eye Off (hidden initially) -->
                            <svg id="iconEyeOff" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.655-3.042M6.18 6.18A9.965 9.965 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-1.091 2.31M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>


                <!-- Checkbox -->
                <div class="flex justify-center items-center mt-5 space-x-2">
                    <input type="checkbox" id="terms" class="h-4 w-4">
                    <label for="terms" class="text-sm">
                        Saya menyetujui <a href="#" class="text-orange-600 font-medium">Syarat dan Ketentuan</a> yang
                        berlaku
                    </label>
                </div>

                <!-- Tombol Daftar -->
                <button type="submit" class="w-50 mx-auto block bg-orange-500 text-white py-3 mt-6 rounded-full font-bold">
                    MASUK
                </button>
            </form>
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');
            const iconEye = document.getElementById('iconEye');
            const iconEyeOff = document.getElementById('iconEyeOff');

            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';

                // swap icons
                if (isPassword) {
                    iconEye.classList.add('hidden');
                    iconEyeOff.classList.remove('hidden');
                    toggleBtn.setAttribute('aria-label', 'Sembunyikan kata sandi');
                    toggleBtn.title = 'Sembunyikan kata sandi';
                } else {
                    iconEye.classList.remove('hidden');
                    iconEyeOff.classList.add('hidden');
                    toggleBtn.setAttribute('aria-label', 'Tampilkan kata sandi');
                    toggleBtn.title = 'Tampilkan kata sandi';
                }
            });
        });
    </script>

@endsection