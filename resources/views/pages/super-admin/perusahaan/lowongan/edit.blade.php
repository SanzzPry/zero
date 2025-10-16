@extends('layouts.dashboard')
@section('title', 'Edit Lowongan')

@section('content')
    <div class="p-8">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-200">
            <h2 class="text-lg font-semibold mb-6">Edit Data Lowongan</h2>

            <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Hidden perusahaan_id --}}
                <input type="hidden" name="perusahaan_id" value="{{ $lowongan->perusahaan_id }}">

                {{-- Baris 1: Judul & Alamat --}}
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-1">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $lowongan->nama) }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Alamat <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat" value="{{ old('alamat', $lowongan->alamat) }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                {{-- Baris 2: Jenis Lowongan & Gaji --}}
                <div class="grid grid-cols-3 gap-6 items-end">
                    <div>
                        <label class="block text-sm font-bold mb-1">Jenis Lowongan <span
                                class="text-red-500">*</span></label>
                        <select name="jenis" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Pilih Jenis</option>
                            @foreach (['Full Time', 'Part Time', 'Freelance', 'Magang'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis', $lowongan->jenis) == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Gaji --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-bold mb-1">Gaji <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            {{-- Displayed for user --}}
                            <input type="text" id="gaji_awal_display"
                                value="Rp {{ number_format($lowongan->gaji_awal, 0, ',', '.') }}"
                                placeholder="Min"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <input type="hidden" id="gaji_awal_hidden" name="gaji_awal"
                                value="{{ $lowongan->gaji_awal }}">

                            <span class="text-gray-600 font-semibold">-</span>

                            <input type="text" id="gaji_akhir_display"
                                value="Rp {{ number_format($lowongan->gaji_akhir, 0, ',', '.') }}"
                                placeholder="Max"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <input type="hidden" id="gaji_akhir_hidden" name="gaji_akhir"
                                value="{{ $lowongan->gaji_akhir }}">

                            <select name="label_gaji"
                                class="w-40 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="Bulan" {{ old('label_gaji', $lowongan->label_gaji) == 'Bulan' ? 'selected' : '' }}>/ Bulan</option>
                                <option value="Minggu" {{ old('label_gaji', $lowongan->label_gaji) == 'Minggu' ? 'selected' : '' }}>/ Minggu</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" required placeholder="Deskripsi Lowongan" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                </div>

                {{-- Syarat Pekerjaan --}}
                <div>
                    <h3 class="text-base font-bold mb-3">Syarat Pekerjaan</h3>

                    @php
                        $syarat = json_decode($lowongan->syarat_pekerjaan, true);
                    @endphp

                    {{-- Pendidikan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Pendidikan <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-4">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'S1', 'S2', 'S3'] as $p)
                                <label class="flex items-center gap-1 text-sm">
                                    <input type="radio" name="pendidikan" value="{{ $p }}" required
                                        {{ (old('pendidikan', $syarat['pendidikan'] ?? '') == $p) ? 'checked' : '' }}
                                        class="text-orange-500 focus:ring-orange-500">
                                    <span>{{ $p }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Jurusan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan', $syarat['jurusan'] ?? '') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Gender <span class="text-red-500">*</span></label>
                        <div class="flex gap-6">
                            @foreach (['Laki-laki', 'Perempuan'] as $g)
                                <label class="flex items-center gap-1 text-sm">
                                    <input type="radio" name="gender" value="{{ $g }}"
                                        {{ (old('gender', $syarat['gender'] ?? '') == $g) ? 'checked' : '' }}
                                        class="text-orange-500 focus:ring-orange-500">
                                    <span>{{ $g }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Umur --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Umur</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="umur_min" placeholder="Min"
                                value="{{ old('umur_min', $syarat['umur_min'] ?? '') }}"
                                class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <span class="text-gray-600 font-semibold">-</span>
                            <input type="number" name="umur_max" placeholder="Max"
                                value="{{ old('umur_max', $syarat['umur_max'] ?? '') }}"
                                class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    {{-- Batas Waktu --}}
                    <div>
                        <label class="block text-sm font-bold mb-1">Batas Waktu <span class="text-red-500">*</span></label>
                        <input type="date" name="batas_lamaran"
                            value="{{ old('batas_lamaran', \Carbon\Carbon::parse($lowongan->batas_lamaran)->format('Y-m-d')) }}"
                            required
                            class="border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-center gap-4 pt-6">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-10 py-2 rounded-xl shadow">
                        Update
                    </button>
                    <a href="{{ url()->previous() }}"
                        class="border border-orange-500 text-orange-500 hover:bg-orange-50 font-medium px-10 py-2 rounded-xl shadow">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return 'Rp ' + rupiah;
        }

        function setupRupiahInput(displayId, hiddenId) {
            const displayInput = document.getElementById(displayId);
            const hiddenInput = document.getElementById(hiddenId);
            displayInput.addEventListener('keyup', function () {
                displayInput.value = formatRupiah(this.value);
                hiddenInput.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        setupRupiahInput("gaji_awal_display", "gaji_awal_hidden");
        setupRupiahInput("gaji_akhir_display", "gaji_akhir_hidden");
    </script>
@endsection
