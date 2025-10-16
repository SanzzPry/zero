@extends('layouts.dashboard')
@section('title', 'Kelola Akun')

@section('content')

    <div class="px-20 py-2">
        <div class="bg-white border rounded-xl px-11 py-2">
            <h2 class="text-xl text-center mb-3">Edit Profile</h2>

            <form action="{{ route('akun.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <!-- Header Profile -->
                <div class="flex flex-col items-center mb-4">
                    <div class="relative flex flex-col items-center justify-center">
                        <img id="profile-preview"
                            src="{{ $user->superAdmin->img_profile ? asset('storage/' . $user->superAdmin->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=random' }}"
                            alt="Profile Photo"
                            class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                        <div class="mt-1">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="img_profile" class="hidden" onchange="previewImage(event)">
                                Upload
                            </label>
                            <button type="submit" name="remove_photo" value="1"
                                class="px-3 py-1  bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                                Remove Photo
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Info Grid -->
                <div class="space-y-2">

                    <!-- Row 1: Username & Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID User</label>
                            <input type="text" name="username" class="mt-1 block w-full rounded-md border px-3 py-2"
                                value="{{ $user->username }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" class="mt-1 block w-full rounded-md border px-3 py-2"
                                value="{{ $user->email}}">
                        </div>
                    </div>

                    <!-- Row 2: Nama Lengkap -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{$user->superAdmin->nama_lengkap}}"
                                class="mt-1 block w-full rounded-md border px-3 py-2">
                        </div>
                        <div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">User</label>
                                <input type="text" name="user_display" value="{{$user->role}}"
                                    class="mt-1 block w-full rounded-md border px-3 py-2">
                            </div>

                        </div>
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
                            <input type="text" name="desa" value="{{ $user->superAdmin->desa }}"
                                class="mt-1 block w-full rounded-md border px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input type="text" name="kode_pos" value="{{ $user->superAdmin->kode_pos }}"
                                class="mt-1 block w-full rounded-md border px-3 py-2">
                        </div>
                    </div>

                    <!-- Row 5: Alamat Detail -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Detail</label>
                        <textarea rows="3" name="detail_alamat"
                            class="mt-1 block w-full rounded-md border px-3 py-2">{{ $user->superAdmin->detail_alamat }}</textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="flex justify-center gap-4 text-center mt-3">
                    <button type="submit"
                        class="pr-8 pl-6 py-2 bg-green-500 hover:bg-green-700 text-white font-semibold rounded-md shadow">
                        Simpan
                    </button>
                    <a href="{{ route('akun.index') }}"
                        class="pr-8 pl-6 py-2 bg-red-500 hover:bg-red-700 text-white font-semibold rounded-md shadow">
                        Batal </a>

                </div>
            </form>
        </div>
    </div>
    <script>
        let oldProvinceId = "{{ $user->superAdmin->province_id ?? '' }}"
        let oldCityId = "{{ $user->superAdmin->city_id ?? '' }}"
        let oldDistrictId = "{{ $user->superAdmin->district_id ?? '' }}"

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profile-preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection