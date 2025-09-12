@extends('layouts.dashboard')
@section('title', 'Pengaturan')

@section('content')
    <div class="px-32 py-14">

        {{-- Overlay Pesan --}}
        @if (session('success'))
            <div id="alert-overlay" class="fixed inset-0 flex items-center justify-center z-50 ">
                <div class="bg-white p-28 rounded-lg shadow-lg text-center w-[600px] relative ">

                    <button onclick="document.getElementById('alert-overlay').remove()"
                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
                        &times;
                    </button>

                    <!-- Icon Success -->
                    <div class="flex justify-center mb-4">
                        <div class="bg-green-200 rounded-full p-3.5">
                            <div class="bg-green-500 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <p class="text-gray-800 text-lg font-medium">{{ session('success') }}</p>

                    <!-- Tombol -->
                    {{-- <button onclick="document.getElementById('alert-overlay').remove()"
                                                                                                                                                                                                                                                                                                                                                    class="mt-6 px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                                                                                                                                                                                                                                                                                                                                    OK --}}
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-overlay" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-28 rounded-lg shadow-lg text-center w-[600px] relative">
                    <h2 class="text-lg font-semibold text-red-600 mb-2">Failed</h2>
                    <div class="flex justify-center mb-4">
                        <div class="bg-red-200 rounded-full p-3.5">
                            <div class="bg-red-500 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700">{{ session('error') }}</p>


                    <button onclick="document.getElementById('alert-overlay').remove()"
                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
                        &times;
                    </button>
                </div>
            </div>
        @endif

        <div class="bg-white border rounded-xl p-10 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Perketat keamanan akun anda</h2>

            <!-- Card Ganti Password -->
            <div class="border rounded-lg">
                <!-- Header -->
                <div class="bg-orange-500 text-white font-semibold px-5 py-3 rounded-t-lg">
                    Ganti Password
                </div>

                <!-- Form -->
                <form action="{{ route('pengaturan.update') }}" method="POST" class="p-6 space-y-5">
                    @csrf @method('PUT')

                    <!-- Kata Sandi Lama -->
                    <div class="grid grid-cols-3 items-center gap-4">
                        <label class="text-gray-700 font-medium">Kata Sandi Lama</label>
                        <input type="password" name="old_password"
                            class="col-span-2 border rounded-lg px-4 py-2 focus:ring-2 @error('old_password') border-red-500 @enderror">
                        @error('old_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- Kata Sandi Baru -->
                    <div class="grid grid-cols-3 items-center gap-4">
                        <label class="text-gray-700 font-medium">Kata Sandi Baru</label>
                        <input type="password" name="new_password"
                            class="col-span-2 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="grid grid-cols-3 items-center gap-4">
                        <label class="text-gray-700 font-medium">Masukkan Kembali Kata Sandi Baru</label>
                        <input type="password" name="new_confirm_password"
                            class="col-span-2 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                    </div>


                    <!-- Tombol -->
                    <div class="flex space-x-4 pt-2">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-2 rounded-lg transition">
                            Simpan
                        </button>
                        <a href="{{ route('pengaturan.index') }}"
                            class="border border-orange-500 text-orange-500 hover:bg-orange-50 px-6 py-2 rounded-lg font-medium transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
