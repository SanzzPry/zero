@extends('layouts.dashboard')
@section('title', 'Kelola Akun')

@section('content')
    <div class="px-20 py-2">
        <div class="bg-white border rounded-xl px-11 py-2">
            <h2 class="text-xl text-center mb-3">Detail Profile</h2>

            <!-- Header Profile -->
            <div class="flex flex-col items-center mb-8">
                <div class="relative">
                    <img src="{{ $user->superAdmin->img_profile ? asset('storage/' . $user->superAdmin->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=random' }}"
                        alt="Profile Photo" class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow">
                </div>
            </div>

            <!-- Info Grid -->
            <div class="space-y-2">

                <!-- Row 1: Email & Username -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" value="{{ $user->username }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" value="{{ $user->email }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 2: Nama Lengkap -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" value="{{ $user->superAdmin->nama_lengkap ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <input type="text" value="{{ $user->role ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 3: Provinsi, Kota, Kecamatan -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" value="{{ $user->superAdmin->provinsi ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <input type="text" value="{{ $user->superAdmin->kota ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text" value="{{ $user->superAdmin->kecamatan ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 4: Desa & Kode Pos -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="col-start-2">
                        <label class="block text-sm font-medium text-gray-700">Desa</label>
                        <input type="text" value="{{ $user->superAdmin->desa ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                        <input type="text" value="{{ $user->superAdmin->kode_pos ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 5: Alamat Detail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Detail</label>
                    <textarea rows="3" disabled
                        class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50">{{ $user->superAdmin->detail_alamat ?? '-' }}</textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-center gap-4 text-center mt-3">
                <a href="{{ route('akun.index') }}"
                    class="pr-8 pl-6 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                    <- Kembali </a>
            </div>
        </div>
    </div>
@endsection