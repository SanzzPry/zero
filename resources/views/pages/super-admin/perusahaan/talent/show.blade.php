@extends('layouts.dashboard')
@section('title', 'Data Talent Hunter')

@section('content')
    <div class="px-24 py-8">
        <!-- Card Utama -->
        <div class="bg-white border rounded-xl shadow-md overflow-hidden relative">

            <!-- Header -->
            <div class="relative flex items-center justify-center px-10 py-16 border-b rounded-xl ">
                <!-- Logo Kiri -->
                <div class="absolute left-14 flex items-center">
                    <img src="{{ $talent->perusahaan->img_profile ? asset('storage/' . $talent->perusahaan->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($talent->perusahaan->namaPerusahaan) . '&background=random' }}"
                        alt="Logo Perusahaan" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                </div>

                <!-- Nama di Tengah -->
                <h1 class="text-2xl font-bold text-center">{{ $talent->perusahaan->namaPerusahaan }}</h1>


            </div>

            <!-- Info Section -->
            <div class="relative px-6 py-10 space-y-6">




                <div class="space-y-4 text-gray-700">
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Deskripsi</h2>
                        <p class="pl-3">{{ $talent->deskripsi }}</p>
                    </div>



                    <div>
                        <h2 class="text-lg font-semibold mb-4">Alamat Perusahaan</h2>
                        <p class="pl-3">{{ $talent->alamat }}</p>
                    </div>

                    <div class="mt-5">
                        <h2 class="font-semibold text-xl text-gray-900 mb-2 pb-1">Kriteria Kandidat</h2>
                        <div class="grid grid-cols-3 text-lg space-y-1">
                            <div>
                                <p>Posisi yang Dibutuhkan</p>
                                <p>Jenis Kelamin</p>
                                <p>Kisaran Gaji</p>
                                <p>Detail Tambahan</p>
                            </div>
                            <div>
                                <p>: {{ $talent->posisi ?? '-' }}</p>
                                <p>: {{ $talent->gender ?? '-' }}</p>
                                <p>: Rp {{ number_format($talent->gaji_awal, 0, ',', '.') }} Sampai
                                    Rp {{ number_format($talent->gaji_akhir, 0, ',', '.') }}</p>
                                <p>: {{ $talent->pengalaman_kerja ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="mt-5 text-center p-2 flex justify-center gap-4">
            <a href="{{ route('talent.edit', $talent->id) }}"
                class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                Edit
            </a>
            <a href="{{ route('perusahaan.index') }}"
                class="px-8 py-2 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                Kembali
            </a>
        </div>

    </div>
@endsection