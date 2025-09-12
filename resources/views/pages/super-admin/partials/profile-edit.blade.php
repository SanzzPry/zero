@extends('layouts.dashboard')
@section('title', 'Profile')

@section('content')
    <div class="px-7 py-2">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="bg-white border rounded-xl px-11 py-5">
                <h2 class="text-xl font-bold mb-5">Edit Profile</h2>

                <!-- Header Profile -->
                <div class="flex items-center mb-8">
                    <img src="{{ Auth::user()->superAdmin && Auth::user()->superAdmin->img_profile
        ? asset('storage/' . Auth::user()->superAdmin->img_profile)
        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) . '&background=random' }}" alt="Profile"
                        class="w-20 h-20 rounded-full mr-5 object-cover">

                    <div>
                        <p class="font-semibold text-gray-800 text-lg">{{ auth()->user()->username }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        <!-- Upload -->
                        <div class="mt-1">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="img_profile" class="hidden">
                                Upload
                            </label>
                            <button type="submit" name="remove_photo" value="1"
                                class="px-3 py-1  bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                                Remove Photo
                            </button>
                        </div>
                    </div>
                </div>
                <div class=" space-y-3">

                    <!-- Row 1: Email & Username -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID User</label>
                            <input type="text" name="username" class="mt-1 block w-full rounded-md border px-3 py-2"
                                value="{{ $profile->username }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" class="mt-1 block w-full rounded-md border px-3 py-2"
                                value="{{ $profile->email}}">
                        </div>
                    </div>

                    <!-- Row 2: Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap ?? '-' }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Row 3: Provinsi, Kota, Kecamatan -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi </label>
                            <select id="provinsi" name="province_id"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">-- Pilih Provinsi --</option>
                            </select>
                            <input type="hidden" name="provinsi" id="provinsi_name" value="">
                        </div>

                        <!-- Kota -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kota/Kabupaten </label>
                            <select id="kota" name="city_id"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">-- Pilih Kota/Kabupaten --</option>
                            </select>
                            <input type="hidden" name="kota" id="kota_name">
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan </label>
                            <select id="kecamatan" name="district_id"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                            <input type="hidden" name="kecamatan" id="kecamatan_name">
                        </div>
                    </div>


                    <!-- Row 4: Desa & Kode Pos -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="col-start-2">
                            <label class="block text-sm font-medium text-gray-700">Desa</label>
                            <input type="text" name="desa" value="{{ $user->desa ?? '-' }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <!-- Kode Pos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Pos </label>
                            <input type="text" name="kode_pos" value="{{ $user->kode_pos ?? '-' }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>


                    <!-- Row 5: Alamat Detail -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Detail Lainnya </label>
                        <input type="text" name="detail_alamat" value="{{ $user->detail_alamat ?? '-' }}"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div class="text-center p-2 flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                            Save
                        </button>
                        <a href="{{ route('profile') }}"
                            class="px-8 py-2 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Script API Dinamis --}}
    <script>
        let oldProvinceId = "{{ $user->province_id ?? '' }}"
        let oldCityId = "{{ $user->city_id ?? '' }}"
        let oldDistrictId = "{{ $user->district_id ?? '' }}"
    </script>


@endsection