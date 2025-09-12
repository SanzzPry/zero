@extends('layouts.dashboard')
@section('title', 'Profile')

@section('content')
    <div class="px-20 py-2">
        <div class="bg-white border rounded-xl px-11 py-2">
            <h2 class="text-xl font-bold mb-5">Profile</h2>

            <!-- Header Profile -->
            <div class="flex items-center mb-8">
                <img src="{{ Auth::user()->superAdmin && Auth::user()->superAdmin->img_profile ? asset('storage/' . Auth::user()->superAdmin->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) . '&background=random' }}"
                    alt="Profile" class="w-20 h-20 rounded-full mr-5 object-cover">

                <div>
                    <p class="font-semibold text-gray-800 text-lg">{{ $profile->username }}</p>
                    <p class="text-sm text-gray-500">{{ $profile->email }}</p>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="space-y-4">

                <!-- Row 1: Email & Username -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" value="{{ $profile->email }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" value="{{ $profile->username }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 2: Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" value="{{ $user->nama_lengkap ?? '-' }}"
                        class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                </div>

                <!-- Row 3: Provinsi, Kota, Kecamatan -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" value="{{ $user->provinsi ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <input type="text" value="{{ $user->kota ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text" value="{{ $user->kecamatan ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 4: Desa & Kode Pos -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="col-start-2">
                        <label class="block text-sm font-medium text-gray-700">Desa</label>
                        <input type="text" value="{{ $user->desa ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                        <input type="text" value="{{ $user->kode_pos ?? '-' }}"
                            class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50" disabled>
                    </div>
                </div>

                <!-- Row 5: Alamat Detail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Detail</label>
                    <textarea rows="3" disabled
                        class="mt-1 block w-full text-gray-600 rounded-md border px-3 py-2 bg-gray-50">{{ $user->detail_alamat ?? '-' }}</textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-center gap-4 text-center mt-3">
                <a href="{{ route('profile.edit') }}"
                    class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection