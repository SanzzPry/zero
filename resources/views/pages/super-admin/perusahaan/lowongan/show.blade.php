@extends('layouts.dashboard')

@section('content')
            <div class="px-24 py-8">
                <!-- Card Utama -->
                <div class="bg-white border rounded-xl shadow-md overflow-hidden relative">

                    <!-- Header -->
                    <div class="relative flex items-center justify-center px-10 py-16 border-b rounded-xl ">
                        <!-- Logo Kiri -->
                        <div class="absolute left-14 flex items-center">
                            <img src="{{ $lowongan->perusahaan->img_profile ? asset('storage/' . $lowongan->perusahaan->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($lowongan->perusahaan->namaPerusahaan) . '&background=random' }}"
                                alt="Logo Perusahaan" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                        </div>

                        <!-- Nama di Tengah -->
                        <h1 class="text-2xl font-bold text-center">{{ $lowongan->nama }}</h1>


                    </div>

                    <!-- Info Section -->
                    <div class="relative px-14 py-10 space-y-6">

                        <!-- Tombol Edit & Hapus (pojok kanan atas) -->
                        <div class="absolute top-6 right-10 flex space-x-4 text-sm">
                            <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center text-red-500 hover:text-red-600">
                                    <i class="bi bi-trash3 mr-1"></i> hapus lowongan
                                </button>
                            </form>
                            <a href="{{ route('lowongan.edit', $lowongan->id) }}"
                                class="flex items-center text-orange-500 hover:text-orange-600">
                                <i class="bi bi-pencil-square mr-1"></i> edit lowongan
                            </a>
                        </div>

                        <h2 class="text-lg font-semibold mb-4">Detail Lowongan</h2>

                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold">Gaji</h3>
                                <p>Rp{{ number_format($lowongan->gaji_awal, 0, ',', '.') }} -
                                    Rp{{ number_format($lowongan->gaji_akhir, 0, ',', '.') }} per bulan</p>
                            </div>

                            <div>
                                <h3 class="font-semibold">Jenis Lowongan</h3>
                                <p>{{ $lowongan->jenis }}</p>
                            </div>

                            <div>
                                <h3 class="font-semibold">Deskripsi Pekerjaan</h3>
                                <div class="text-sm leading-relaxed whitespace-pre-line">
                                    {!! nl2br(e($lowongan->deskripsi)) !!}
                                </div>
                            </div>

                            <div>
                                <h3 class="font-semibold">Syarat Pekerjaan</h3>
                                @php
    $syarat = json_decode($lowongan->syarat_pekerjaan, true);
                                @endphp
                                @if ($syarat)
                                    <ul class="list-disc pl-5 text-sm leading-relaxed">
                                        <li>Pendidikan: {{ $syarat['pendidikan'] ?? '-' }}</li>
                                        <li>Jurusan: {{ $syarat['jurusan'] ?? '-' }}</li>
                                        <li>Gender: {{ $syarat['gender'] ?? '-' }}</li>
                                        <li>Umur: {{ $syarat['umur_min'] ?? '-' }} - {{ $syarat['umur_max'] ?? '-' }}</li>
                                        <li>Batas Lamaran: {{ \Carbon\Carbon::parse($lowongan->batas_lamaran)->format('d M Y') }}
                                        </li>
                                    </ul>
                                @endif
                            </div>

                            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-xl p-4">
                                <h3 class="font-semibold text-gray-700 mb-2">Aktivitas Lowongan</h3>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p>🕒 Dipasang {{ $lowongan->created_at->diffForHumans() }}</p>
                                    <p>✏️ Diperbarui {{ $lowongan->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="mt-8 flex flex-col items-center justify-center  space-y-4 ">


                    <a href="{{ route('perusahaan.show', $lowongan->perusahaan_id) }}"
                        class="w-full md:w-1/3 bg-orange-400 hover:bg-orange-500 text-white px-12 py-3 rounded-md font-medium shadow text-center">
                        Kembali
                    </a>
                </div>

            </div>
@endsection
