@extends('layouts.res')
@section('title', 'sign-in')
@section('main')
    <div class="min-h-screen flex">
        <!-- Bagian kiri (Info) -->
        <div class="w-1/2 relative hidden md:flex items-center justify-center bg-cover bg-center"
            style="background-image: url('/images/furin.jpg')">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 text-center text-white px-12">
                <h1 class="text-5xl font-bold mb-6">Super Admin Area Kerja</h1>
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
                        <input type="password" name="password" placeholder="Kata Sandi"
                            class="w-full border rounded-lg px-6 py-4">
                        <span class="absolute right-3 top-2.5 cursor-pointer">👁</span>
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

@endsection