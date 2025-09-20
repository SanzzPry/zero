@extends('layouts.dashboard')
@section('title', 'Tambah Perusahaan')

@section('content')
    <div class="px-13 py-2">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="bg-white border rounded-xl px-18 py-6 mb-18">
                <h2 class="text-xl font-bold mb-5">Edit Kandidat</h2>

                <!-- Header Profile -->
                <div class="flex items-center mb-8">
                    <img id="profile-preview"
                        src="{{ old('photo') ? asset('storage/' . old('photo')) : 'https://ui-avatars.com/api/?name=' . '&background=random' }}"
                        alt="Profile Photo"
                        class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                    <div>
                        <div class="ml-8 mt-1 space-x-2">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="photo" class="hidden">
                                Upload
                            </label>
                            <button type="submit" name="remove_photo" value="1"
                                class="px-3 py-1 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">

                    <!-- User ID -->
                    <div>
                        <label class="block text-sm font-bold">User ID <span class="text-red-500">*</span></label>
                        <input type="text" name="user_id" placeholder="User ID"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="Email"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-bold">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" placeholder="Username"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-bold">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Kata Sandi -->
                    <div>
                        <label class="block text-sm font-bold">Kata Sandi <span class="text-red-500">*</span></label>
                        <input type="password" name="password" placeholder="Kata Sandi"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-bold">Gender <span class="text-red-500">*</span></label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Laki-Laki" class="mr-2"> Laki-Laki
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Perempuan" class="mr-2"> Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-bold">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" placeholder="Alamat"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label class="block text-sm font-bold">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" placeholder="No. Telepon"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Pendidikan -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Pendidikan <span class="text-red-500">*</span></label>
                        <button type="button"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow">
                            Tambahkan Pendidikan
                            <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- Organisasi -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Organisasi <span class="text-red-500">*</span></label>
                        <button type="button"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow">
                            Tambahkan Organisasi
                            <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- Pengalaman -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Pengalaman <span class="text-red-500">*</span></label>
                        <button type="button"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow">
                            Tambahkan Pengalaman Kerja
                            <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- Skill -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Skill <span class="text-red-500">*</span></label>
                        <button type="button"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow">
                            Tambahkan Skill
                            <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- Social Media -->
                    <h3 class="text-lg font-bold mt-6">Social Media</h3>
                    <div>
                        <input type="text" name="instagram" placeholder="Instagram"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <input type="text" name="linkedin" placeholder="LinkedIn"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <input type="text" name="website" placeholder="Website"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <input type="text" name="twitter" placeholder="Twitter"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center p-2 flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                            Upload
                        </button>
                        <a href="{{ route('pelamar.index') }}"
                            class="px-8 py-2 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection