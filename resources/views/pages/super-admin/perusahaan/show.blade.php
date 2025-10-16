@extends('layouts.dashboard')
@section('title', 'Detail Perusahaan')

@section('content')
    <div class="px-12 py-6">

        {{-- HEADER CARD: cuma image + nama perusahaan --}}
        <div class="flex items-center bg-white rounded-3xl shadow border border-gray-200 p-8 mb-8">
            <div class="flex-shrink-0">
                <img src="{{ $perusahaan->img_profile ? asset('storage/' . $perusahaan->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($perusahaan->namaPerusahaan) . '&background=random' }}"
                    alt="Logo Perusahaan" class="w-28 h-28 rounded-full object-cover border border-gray-300 shadow mr-6">
            </div>

            <div class="flex-1 flex items-center justify-center">
                <h1 class="text-2xl font-bold">{{ $perusahaan->namaPerusahaan }}</h1>
            </div>
        </div>


        {{-- MAIN CARD: semua konten detail berada di sini (terpisah dari header) --}}
        <div class="bg-white rounded-3xl p-8">
            {{-- Deskripsi --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $perusahaan->deskripsi ?? '-' }}
                </p>
            </div>

            {{-- Visi --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Visi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $perusahaan->visi ?? '-' }}
                </p>
            </div>

            {{-- Misi --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Misi</h2>
                @if ($perusahaan->misi)
                    <ul class="list-disc ml-6 text-gray-700">
                        @foreach (preg_split("/\r\n|\n|\r/", $perusahaan->misi) as $item)
                            @if(trim($item) !== '')
                                <li>{{ $item }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700">-</p>
                @endif
            </div>

            {{-- Data Perusahaan --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Data Perusahaan</h2>
                <div class="space-y-1 text-gray-800">
                    <div class="flex">
                        <span class="w-60">User ID</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->user->id ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-60">Username</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->user->username ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-60">Email</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->user->email ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-60">Nama Perusahaan</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->namaPerusahaan ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-60">Legalitas</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->legalitas ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Kontak</h2>
                <div class="space-y-1 text-gray-800">
                    <div class="flex">
                        <span class="w-60">Perusahaan</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->teleponPerusahaan ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-60">Whatsapp</span>
                        <span class="mr-2">:</span>
                        <span>{{ $perusahaan->whatsapp ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Lowongan --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-3">Lowongan</h2>
                @if ($perusahaan->lowongan && $perusahaan->lowongan->count())
                    <div class="space-y-3">
                        @foreach ($perusahaan->lowongan as $low)
                            <div>
                                <a href="{{ route('lowongan.show', $low->id) }}" class="text-blue-600 hover:underline font-medium">
                                    {{ $low->nama }}
                                </a>
                                <p class="text-sm text-gray-500">
                                    {{ $low->alamat ?? '-' }} — {{ $low->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Belum ada lowongan</p>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col items-center gap-4 mt-30">
                {{-- Tambah Lowongan --}}
                <a href="{{ route('lowongan.create', ['perusahaan_id' => $perusahaan->id]) }}"
                    class="w-full md:w-1/3 px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow text-center">
                    Tambah Lowongan
                </a>


                {{-- Edit --}}
                <a href="{{ route('perusahaan.edit', $perusahaan->id) }}"
                    class="w-full md:w-1/3 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow text-center">
                    Edit
                </a>

                {{-- Hapus --}}
                <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?')" class="w-full md:w-1/3">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md shadow text-center">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection