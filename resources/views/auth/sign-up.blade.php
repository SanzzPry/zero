@extends('layouts.res')
@section('title', 'sign-up')
@section('main')
    <div class="min-h-screen flex">

        {{-- Overlay Pesan --}}
        @if (session('success'))
            <div id="alert-overlay" class="fixed inset-0 flex items-center justify-center  z-50">
                <div class="bg-white p-10 rounded-2xl shadow-xl text-center w-[500px] relative">

                    <h1 class="text-gray-800 text-b font-xl text-2xl">{{ session('success')}}</h1>
                    <!-- Pesan -->
                    <p class="text-gray-600 text-lg mb-6">
                        Setelah ini anda hanya perlu login <br> untuk terhubung dengan AreaKerja.
                    </p>

                    <!-- Tombol Aksi -->
                    <a href="{{ url('auth/login') }}"
                        class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Masuk
                    </a>
                </div>
            </div>

        @endif


        <!-- Bagian Kiri (Form) -->
        <div class="w-1/2 flex flex-col justify-center px-12">
            <!-- Logo -->
            <div class="absolute top-6 left-12 flex items-center">
                <img src="/images/logo-orange.svg" alt="Logo" class="h-8">
                <span class="text-lg font-bold text-orange-500 ml-2">areakerja.com</span>
            </div>


            <!-- Judul -->
            <h2 class="text-2xl font-bold text-center mb-6">Buat Akun</h2>

            <!-- Social Login -->
            <div class="flex justify-center space-x-4 mb-6">
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">G</button>
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">f</button>
                <button class="w-10 h-10 rounded-full border flex items-center justify-center">in</button>
            </div>

            <!-- Form -->
            <form action="{{ route('register')}}" method="POST" class="space-y-2 w-120 mx-auto">
                @csrf @method('POST')
                <div>
                    <label class="block text-sm font-medium pb-2">Nama Pengguna</label>
                    <input type="text" name="username" placeholder="Nama Pengguna"
                        class="w-full border rounded-lg px-6 py-4">
                </div>
                <div>
                    <label class="block text-sm font-medium pb-2">E-mail</label>
                    <input type="email" name="email" placeholder="E-mail" class="w-full border rounded-lg px-6 py-4">
                </div>
                {{-- <div>
                        <label class="block text-sm font-medium pb-2">No. Tlp</label>
                        <input type="number" name="no_tlp" placeholder="No. Tlp" class="w-full border rounded-lg px-6 py-4">
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
                    DAFTAR
                </button>
            </form>
        </div>

        <!-- Bagian Kanan (Info) -->
        <div class="w-1/2 relative hidden md:flex items-center justify-center bg-cover bg-center"
            style="background-image: url('/images/furin.jpg')">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 text-center text-white px-12">
                <img src="/images/Logo-area_kerja-white.png" class="h-10 mx-auto mb-6">
                <h1 class="text-5xl font-bold mb-6">Super Admin Area Kerja</h1>
                <p class="mb-16">untuk tetap terhubung dengan kami <br> silakan masuk dengan informasi pribadi Anda</p>
                <a href="{{ route('auth.login')}}"
                    class="px-18 py-4 border border-white rounded-full hover:bg-white hover:text-black transition">
                    MASUK
                </a>
            </div>
        </div>
    </div>

@endsection
