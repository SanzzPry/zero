@extends('layouts.dashboard')
@section('title', 'Tambah Lowongan')

@section('content')
    <div class="p-8">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-200">
            <h2 class="text-lg font-semibold mb-6">Tambah Data Lowongan</h2>

            <form action="{{ route('lowongan.store') }}" method="POST" class="space-y-8">
                @csrf
                @if(isset($perusahaan_id))
                    <input type="hidden" name="perusahaan_id" value="{{ $perusahaan_id }}">
                @endif

                {{-- Baris 1: Judul & Alamat --}}
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-1">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Alamat <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat" required
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
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Freelance</option>
                            <option>Magang</option>
                        </select>
                    </div>

                    {{-- Input Gaji --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-bold mb-1">Gaji <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            {{-- Displayed for user --}}
                            <input type="text" id="gaji_awal_display" placeholder="Min"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <input type="hidden" id="gaji_awal_hidden" name="gaji_awal">

                            <span class="text-gray-600 font-semibold">-</span>

                            <input type="text" id="gaji_akhir_display" placeholder="Max"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <input type="hidden" id="gaji_akhir_hidden" name="gaji_akhir">

                            <select name="label_gaji"
                                class="w-40 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="Bulan">/ Bulan</option>
                                <option value="Minggu">/ Minggu</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" required placeholder="Deskripsi Lowongan" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                </div>

                {{-- Syarat Pekerjaan --}}
                <div>
                    <h3 class="text-base font-bold mb-3">Syarat Pekerjaan</h3>

                    {{-- Pendidikan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Pendidikan <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-4">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'S1', 'S2', 'S3'] as $p)
                                <label class="flex items-center gap-1 text-sm">
                                    <input type="radio" name="pendidikan" value="{{ $p }}" required
                                        class="text-orange-500 focus:ring-orange-500">
                                    <span>{{ $p }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Jurusan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Jurusan</label>
                        <input type="text" name="jurusan"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Gender <span class="text-red-500">*</span></label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-1 text-sm">
                                <input type="radio" name="gender" value="Laki-laki" required
                                    class="text-orange-500 focus:ring-orange-500">
                                <span>Laki-Laki</span>
                            </label>
                            <label class="flex items-center gap-1 text-sm">
                                <input type="radio" name="gender" value="Perempuan"
                                    class="text-orange-500 focus:ring-orange-500">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Umur --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Umur</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="umur_min" placeholder="Min"
                                class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                            <span class="text-gray-600 font-semibold">-</span>
                            <input type="number" name="umur_max" placeholder="Max"
                                class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    {{-- Batas Waktu --}}
                    <div>
                        <label class="block text-sm font-bold mb-1">Batas Waktu <span class="text-red-500">*</span></label>
                        <input type="date" name="batas_lamaran" required
                            class="border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-center gap-4 pt-6">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-10 py-2 rounded-xl shadow">
                        Simpan
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