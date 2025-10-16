@extends('layouts.dashboard')
@section('title', 'Edit Kandidat')

@section('content')
    <div class="px-13 py-2">
        <form action="{{ route('pelamar.update', $pelamar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white border rounded-xl px-18 py-6 mb-18">
                <h2 class="text-xl font-bold mb-5">Edit Kandidat</h2>

                <!-- Header Profile -->
                <div class="flex items-center mb-8">
                    <img id="profile-preview"
                        src="{{ $pelamar->img_profile ? asset('storage/' . $pelamar->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($pelamar->full_name) . '&background=random' }}"
                        alt="Profile Photo"
                        class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                    <div>
                        <div class="ml-8 mt-1 space-x-2">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="img_profile" class="hidden" onchange="previewImage(event)">
                                Ganti Foto
                            </label>
                            <button type="submit" name="remove_photo" value="1"
                                class="px-3 py-1 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $pelamar->user->email) }}" placeholder="Email"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-bold">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" value="{{ old('username', $pelamar->user->username) }}" placeholder="Username"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-bold">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" value="{{ old('nama_pelamar', $pelamar->nama_pelamar) }}" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Kata Sandi -->
                    <div>
                        <label class="block text-sm font-bold">Kata Sandi</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-bold">Gender <span class="text-red-500">*</span></label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Laki-Laki" class="mr-2"
                                    {{ old('gender', $pelamar->gender) == 'laki-laki' ? 'checked' : '' }}> Laki-Laki
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Perempuan" class="mr-2"
                                    {{ old('gender', $pelamar->gender) == 'perempuan' ? 'checked' : '' }}> Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-bold">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" placeholder="Alamat"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">{{ old('alamat', $pelamar->alamat) }}</textarea>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label class="block text-sm font-bold">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('teleponPelamar', $pelamar->teleponPelamar) }}" placeholder="No. Telepon"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    {{-- ==================== Riwayat Pendidikan ==================== --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold">Riwayat Pendidikan</label>
                        <div id="pendidikan-container" class="space-y-3">
                            @foreach ($pelamar->riwayatPendidikans ?? [] as $i => $edu)
                                <div class="grid grid-cols-5 gap-3 pendidikan-item relative">
                                    <input type="text" name="educations[{{ $i }}][pendidikan]" value="{{ $edu->pendidikan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="educations[{{ $i }}][jurusan]" value="{{ $edu->jurusan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="educations[{{ $i }}][asal_pendidikan]" value="{{ $edu->asal_pendidikan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="educations[{{ $i }}][tahun_awal]" value="{{ $edu->tahun_awal }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="educations[{{ $i }}][tahun_akhir]" value="{{ $edu->tahun_akhir }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <button type="button" onclick="removeItem(this)"
                                        class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addEducation()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Pendidikan <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    {{-- ==================== Pengalaman Kerja ==================== --}}
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Pengalaman Kerja</label>
                        <div id="pengalaman-container" class="space-y-3">
                            @foreach ($pelamar->pengalamanKerjas ?? [] as $i => $exp)
                                <div class="grid grid-cols-6 gap-3 pengalaman-item relative">
                                    <input type="text" name="experiences[{{ $i }}][posisi_pekerjaan]" value="{{ $exp->posisi_pekerjaan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="experiences[{{ $i }}][jabatan_pekerjaan]" value="{{ $exp->jabatan_pekerjaan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="experiences[{{ $i }}][nama_perusahaan]" value="{{ $exp->nama_perusahaan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="experiences[{{ $i }}][tahun_awal]" value="{{ $exp->tahun_awal }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="experiences[{{ $i }}][tahun_akhir]" value="{{ $exp->tahun_akhir }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <textarea name="experiences[{{ $i }}][deskripsi]" class="w-full rounded-md border px-3 py-2">{{ $exp->deskripsi }}</textarea>
                                    <button type="button" onclick="removeItem(this)"
                                        class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addPengalaman()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Pengalaman Kerja <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    {{-- ==================== Organisasi ==================== --}}
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Pengalaman Organisasi</label>
                        <div id="organisasi-container" class="space-y-3">
                            @foreach ($pelamar->pengalamanOrganisasis ?? [] as $i => $org)
                                <div class="grid grid-cols-5 gap-3 organisasi-item relative">
                                    <input type="text" name="organizations[{{ $i }}][nama_organisasi]" value="{{ $org->nama_organisasi }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="organizations[{{ $i }}][jabatan]" value="{{ $org->jabatan }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="organizations[{{ $i }}][tahun_awal]" value="{{ $org->tahun_awal }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <input type="text" name="organizations[{{ $i }}][tahun_akhir]" value="{{ $org->tahun_akhir }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <textarea name="organizations[{{ $i }}][deskripsi]" class="w-full rounded-md border px-3 py-2">{{ $org->deskripsi }}</textarea>
                                    <button type="button" onclick="removeItem(this)"
                                        class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addOrganisasi()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Organisasi <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    {{-- ==================== Skill ==================== --}}
                    <div class="space-y-1 mt-6">
                        <label class="block text-sm font-bold">Skill</label>
                        <div id="skill-container" class="space-y-3">
                            @foreach ($pelamar->skills ?? [] as $i => $skill)
                                <div class="grid grid-cols-2 gap-3 skill-item relative">
                                    <input type="text" name="skills[{{ $i }}][skill]" value="{{ $skill->skill }}"
                                        class="w-full rounded-md border px-3 py-2">
                                    <select name="skills[{{ $i }}][experience_level]" class="w-full rounded-md border px-3 py-2">
                                        <option value="">-- Level --</option>
                                        <option value="Beginner" {{ $skill->experience_level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="Intermediate" {{ $skill->experience_level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Expert" {{ $skill->experience_level == 'Expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                    <button type="button" onclick="removeItem(this)"
                                        class="absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full">✖</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addSkill()"
                            class="w-full flex justify-between items-center bg-orange-500 text-white px-4 py-2 rounded-md shadow mt-2">
                            Tambahkan Skill <span class="text-xl font-bold">+</span>
                        </button>
                    </div>

                    {{-- ==================== Sosial Media ==================== --}}
                    <h3 class="text-lg font-bold mt-6">Social Media</h3>
                    <div><input type="text" name="socials[instagram]" value="{{ $pelamar->socialMediaPelamar->instagram }}"
                            placeholder="Instagram" class="mt-1 block w-full rounded-md border px-3 py-2"></div>
                    <div><input type="text" name="socials[linkedin]" value="{{ $pelamar->socialMediaPelamar->linkedin }}"
                            placeholder="LinkedIn" class="mt-1 block w-full rounded-md border px-3 py-2"></div>
                    <div><input type="text" name="socials[website]" value="{{ $pelamar->socialMediaPelamar->website }}"
                            placeholder="Website" class="mt-1 block w-full rounded-md border px-3 py-2"></div>
                    <div><input type="text" name="socials[twitter]" value="{{ $pelamar->socialMediaPelamar->twitter }}"
                            placeholder="Twitter" class="mt-1 block w-full rounded-md border px-3 py-2"></div>

                    <!-- Action Buttons -->
                    <div class="text-center p-2 flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                            Update
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

    {{-- JS untuk tambah/hapus dinamis --}}
    <script>
        let eduIndex = {{ count($pelamar->educations ?? []) }},
            expIndex = {{ count($pelamar->experiences ?? []) }},
            orgIndex = {{ count($pelamar->organizations ?? []) }},
            skillIndex = {{ count($pelamar->skills ?? []) }};



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
