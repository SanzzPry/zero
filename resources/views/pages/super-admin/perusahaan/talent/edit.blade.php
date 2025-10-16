@extends('layouts.dashboard')
@section('title', 'Edit Data Talent Hunter')

@section('content')
    <div class="p-12">
        <div class="bg-white border border-gray-600 rounded-xl px-20 py-8  mx-auto">
            <h1 class="font-semibold text-2xl text-gray-800 mb-6">Tambah Data Talent Hunter</h1>

            <form action="{{ route('talent.update', $talent->id) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <input type="hidden" name="perusahaan_id" value="{{ $talent->perusahaan_id }}">

                <div>
                    <label class="block text-sm font-semibold mb-1">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" value="{{ $talent->alamat }}"
                        class="w-full border rounded-md px-3 py-2 focus:ring-orange-400 focus:border-orange-400"
                        placeholder="Masukkan alamat perusahaan...">
                </div>





                <div>
                    <label class="block text-sm font-semibold mb-1">Deskripsi Perusahaan <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border rounded-md px-3 py-2 focus:ring-orange-400 focus:border-orange-400"
                        placeholder="Ceritakan tentang perusahaan kamu...">{{ $talent->deskripsi }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Posisi yang Dibutuhkan <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="posisi" value="{{ $talent->posisi }}"
                        class="w-full border rounded-md px-3 py-2 focus:ring-orange-400 focus:border-orange-400"
                        placeholder="Contoh: UI/UX Designer, Backend Developer">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Gender</label>
                    <div class="flex items-center space-x-4 mt-1">
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="Laki-Laki" class="mr-2" {{ old('gender', $talent->gender) == 'laki-laki' ? 'checked' : '' }}> Laki-Laki
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="Perempuan" class="mr-2" {{ old('gender', $talent->gender) == 'perempuan' ? 'checked' : '' }}> Perempuan
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Gaji <span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-3">
                        <input type="text" id="gaji_awal_display"
                            value="Rp {{ number_format($talent->gaji_awal, 0, ',', '.') }}" placeholder="Min"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        <input type="hidden" id="gaji_awal_hidden" name="gaji_awal" value="{{ $talent->gaji_awal }}">

                        <span class="text-gray-600 font-semibold">-</span>

                        <input type="text" id="gaji_akhir_display"
                            value="Rp {{ number_format($talent->gaji_akhir, 0, ',', '.') }}" placeholder="Max"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                        <input type="hidden" id="gaji_akhir_hidden" name="gaji_akhir" value="{{ $talent->gaji_akhir }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Detail Tambahan<span
                            class="text-red-500">*</span></label>
                    <textarea name="pengalaman_kerja" rows="3"
                        class="w-full border rounded-md px-3 py-2 focus:ring-orange-400 focus:border-orange-400"
                        placeholder="Tuliskan detail tambahan yang dibutuhkan...">{{ $talent->pengalaman_kerja }}</textarea>
                </div>

                <div class="flex justify-center gap-3 pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md text-sm font-medium">
                        Simpan
                    </button>
                    <a href="{{ route('talent.show', $talent->id) }}"
                        class="px-6 py-2 border border-orange-400 text-orange-500 hover:bg-orange-50 rounded-md text-sm font-medium">
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