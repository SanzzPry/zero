@extends('layouts.dashboard')
@section('title', 'Tambah Perusahaan')

@section('content')
    <div class="px-13 py-2">
        <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')

            <div class="bg-white border rounded-xl px-18 py-6 mb-18">
                <h2 class="text-xl font-bold mb-5">Tambah Perusahaan</h2>

                <!-- Header Profile -->
                <div class="flex items-center mb-8">
                    <img id="profile-preview"
                        src="{{ old('img_profile') ? asset('storage/' . old('img_profile')) : 'https://ui-avatars.com/api/?name=' . '&background=random' }}"
                        alt="Profile Photo"
                        class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                    <div>
                        <div class="ml-8 mt-1 space-x-2">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="img_profile" class="hidden" onchange="previewImage(event)">
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


                    <!-- Kata Sandi -->
                    <div>
                        <label class="block text-sm font-bold">Kata Sandi <span class="text-red-500">*</span></label>
                        <input type="password" name="password" placeholder="Kata Sandi"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <h1 class="font-bold text-xl">Data Perusahaan</h1>

                    <div>
                        <label class="block text-sm font-bold">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="namaPerusahaan" placeholder="Nama Perusahaan"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold">legalitas <span class="text-red-500">*</span></label>
                        <input type="text" name="legalitas" placeholder="legalitas"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold">
                            Deskripsi Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" placeholder="Deskripsi Perusahaan"
                            class="mt-1 block w-full h-40 rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold">
                            Visi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="visi" placeholder="Visi"
                            class="mt-1 block w-full h-40 rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold">
                            Misi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="misi" placeholder="Misi"
                            class="mt-1 block w-full h-40 rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>

                    <h1 class="font-bold text-xl">Nomor Telepon</h1>


                    <!-- No. Telepon -->
                    <div>
                        <label class="block text-sm font-bold">No. Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="teleponPerusahaan" placeholder="No. Perusahaan"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold">No. Whatsapp <span class="text-red-500">*</span></label>
                        <input type="text" name="whatsapp" placeholder="No. Whatsapp"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>



                    <!-- Action Buttons -->
                    <div class="text-center p-2 flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                            Simpan
                        </button>
                        <a href="{{ route('perusahaan.index') }}"
                            class="px-8 py-2 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview foto saat diganti
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profile-preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection