@extends('layouts.dashboard')
@section('title', 'Tambah Kandidat')

@section('content')
    <div class="px-13 py-2">
        <form action="{{ route('pelamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')

            <div class="bg-white border rounded-xl px-18 py-6 mb-18">
                <h2 class="text-xl font-bold mb-5">Edit Kandidat</h2>

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

                    <!-- ==================== PENDIDIKAN ==================== -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Riwayat Pendidikan</label>
                        <div id="pendidikan-container" class="space-y-3">
                            <div class="grid grid-cols-5 gap-3 pendidikan-item relative">
                                <input type="text" name="educations[0][pendidikan]" placeholder="Jenjang (SMA/S1)"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="educations[0][jurusan]" placeholder="Jurusan"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="educations[0][asal_pendidikan]" placeholder="Asal Sekolah/Univ"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="educations[0][tahun_awal]" placeholder="Tahun Awal"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="educations[0][tahun_akhir]" placeholder="Tahun Akhir"
                                    class="w-full rounded-md border px-3 py-2">
                                <button type="button" onclick="removeItem(this)"
                                    class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                            </div>
                        </div>
                        <button type="button" onclick="addEducation()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Pendidikan <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- ==================== PENGALAMAN KERJA ==================== -->
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Pengalaman Kerja</label>
                        <div id="pengalaman-container" class="space-y-3">
                            <div class="grid grid-cols-6 gap-3 pengalaman-item relative">
                                <input type="text" name="experiences[0][posisi_pekerjaan]" placeholder="Posisi"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="experiences[0][jabatan_pekerjaan]" placeholder="Jabatan"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="experiences[0][nama_perusahaan]" placeholder="Perusahaan"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="experiences[0][tahun_awal]" placeholder="Tahun Awal"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="experiences[0][tahun_akhir]" placeholder="Tahun Akhir"
                                    class="w-full rounded-md border px-3 py-2">
                                <textarea name="experiences[0][deskripsi]" placeholder="Deskripsi"
                                    class="w-full rounded-md border px-3 py-2"></textarea>
                                <button type="button" onclick="removeItem(this)"
                                    class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                            </div>
                        </div>
                        <button type="button" onclick="addPengalaman()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Pengalaman Kerja <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- ==================== ORGANISASI ==================== -->
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Pengalaman Organisasi</label>
                        <div id="organisasi-container" class="space-y-3">
                            <div class="grid grid-cols-5 gap-3 organisasi-item relative">
                                <input type="text" name="organizations[0][nama_organisasi]" placeholder="Nama Organisasi"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="organizations[0][jabatan]" placeholder="Jabatan"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="organizations[0][tahun_awal]" placeholder="Tahun Awal"
                                    class="w-full rounded-md border px-3 py-2">
                                <input type="text" name="organizations[0][tahun_akhir]" placeholder="Tahun Akhir"
                                    class="w-full rounded-md border px-3 py-2">
                                <textarea name="organizations[0][deskripsi]" placeholder="Deskripsi"
                                    class="w-full rounded-md border px-3 py-2"></textarea>
                                <button type="button" onclick="removeItem(this)"
                                    class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                            </div>
                        </div>
                        <button type="button" onclick="addOrganisasi()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Organisasi <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- ==================== SKILL ==================== -->
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Skill</label>
                        <div id="skill-container" class="space-y-3">
                            <div class="grid grid-cols-2 gap-3 skill-item relative">
                                <input type="text" name="skills[0][skill]" placeholder="Nama Skill"
                                    class="w-full rounded-md border px-3 py-2">
                                <select name="skills[0][experience_level]" class="w-full rounded-md border px-3 py-2">
                                    <option value="">-- Level --</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Expert">Expert</option>
                                </select>
                                <button type="button" onclick="removeItem(this)"
                                    class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                            </div>
                        </div>
                        <button type="button" onclick="addSkill()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Skill <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    <!-- ==================== SOSMED ==================== -->
                    <h3 class="text-lg font-bold mt-6">Social Media</h3>
                    <div><input type="text" name="socials[instagram]" placeholder="Instagram"
                            class="mt-1 block w-full rounded-md border px-3 py-2">
                    </div>
                    <div><input type="text" name="socials[linkedin]" placeholder="LinkedIn"
                            class="mt-1 block w-full rounded-md border px-3 py-2">
                    </div>
                    <div><input type="text" name="socials[website]" placeholder="Website"
                            class="mt-1 block w-full rounded-md border px-3 py-2">
                    </div>
                    <div><input type="text" name="socials[twitter]" placeholder="Twitter"
                            class="mt-1 block w-full rounded-md border px-3 py-2">
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

    <script>
        let eduIndex = 1, orgIndex = 1, expIndex = 1, skillIndex = 1;

        function removeItem(el) {
            el.parentNode.remove();
        }
        function addEducation() {
            let c = document.getElementById('pendidikan-container');
            c.insertAdjacentHTML('beforeend', `
                                                    <div class="grid grid-cols-5 gap-3 pendidikan-item relative mt-2">
                                                        <input type="text" name="educations[${eduIndex}][pendidikan]" placeholder="Jenjang"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="educations[${eduIndex}][jurusan]" placeholder="Jurusan"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="educations[${eduIndex}][asal_pendidikan]" placeholder="Asal Sekolah/Univ"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="educations[${eduIndex}][tahun_awal]" placeholder="Tahun Awal"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="educations[${eduIndex}][tahun_akhir]" placeholder="Tahun Akhir"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <button type="button" onclick="removeItem(this)" class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                                    </div>`);
            eduIndex++;
        }
        function addPengalaman() {
            let c = document.getElementById('pengalaman-container');
            c.insertAdjacentHTML('beforeend', `
                                                    <div class="grid grid-cols-6 gap-3 pengalaman-item relative mt-2">
                                                        <input type="text" name="experiences[${expIndex}][posisi_pekerjaan]" placeholder="Posisi"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="experiences[${expIndex}][jabatan_pekerjaan]" placeholder="Jabatan"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="experiences[${expIndex}][nama_perusahaan]" placeholder="Perusahaan"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="experiences[${expIndex}][tahun_awal]" placeholder="Tahun Awal"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="experiences[${expIndex}][tahun_akhir]" placeholder="Tahun Akhir"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <textarea name="experiences[${expIndex}][deskripsi]" placeholder="Deskripsi" class="w-full rounded-md border px-3 py-2"></textarea>
                                                        <button type="button" onclick="removeItem(this)" class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                                    </div>`);
            expIndex++;
        }
        function addOrganisasi() {
            let c = document.getElementById('organisasi-container');
            c.insertAdjacentHTML('beforeend', `
                                                    <div class="grid grid-cols-5 gap-3 organisasi-item relative mt-2">
                                                        <input type="text" name="organizations[${orgIndex}][nama_organisasi]" placeholder="Nama Organisasi"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="organizations[${orgIndex}][jabatan]" placeholder="Jabatan"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="organizations[${orgIndex}][tahun_awal]" placeholder="Tahun Awal"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <input type="text" name="organizations[${orgIndex}][tahun_akhir]" placeholder="Tahun Akhir"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <textarea name="organizations[${orgIndex}][deskripsi]" placeholder="Deskripsi" class="w-full rounded-md border px-3 py-2"></textarea>
                                                        <button type="button" onclick="removeItem(this)" class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                                    </div>`);
            orgIndex++;
        }
        function addSkill() {
            let c = document.getElementById('skill-container');
            c.insertAdjacentHTML('beforeend', `
                                                    <div class="grid grid-cols-2 gap-3 skill-item relative mt-2">
                                                        <input type="text" name="skills[${skillIndex}][skill]" placeholder="Nama Skill"
                                                            class="w-full rounded-md border px-3 py-2">
                                                        <select name="skills[${skillIndex}][experience_level]" class="w-full rounded-md border px-3 py-2">
                                                            <option value="">-- Level --</option>
                                                            <option value="Beginner">Beginner</option>
                                                            <option value="Intermediate">Intermediate</option>
                                                            <option value="Expert">Expert</option>
                                                        </select>
                                                        <button type="button" onclick="removeItem(this)" class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                                    </div>`);
            skillIndex++;
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profile-preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection