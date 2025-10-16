@extends('layouts.dashboard')
@section('title', 'Detail Pelamar')

@section('content')
<div class="p-2 bg-white rounded-xl shadow-md max-w-6xl mx-auto mt-6">
    <div class="px-24 py-14">
        {{-- Header Profil --}}
        <div class="flex items-start gap-6">
            <img src="{{ $pelamar->img_profile ? asset('storage/' . $pelamar->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($pelamar->username) . '&background=random' }}"
                alt="Foto Pelamar" class="w-24 h-24 rounded-full object-cover shadow">
            <div class="flex-1 pl-3">
                <h2 class="text-2xl font-bold text-gray-800">{{ $pelamar->nama_pelamar }}</h2>
                <p class="text-md text-gray-600 leading-snug">
                    {{ $pelamar->deskripsi ?? 'Saya adalah pelamar dengan minat besar dalam pengembangan web dan aplikasi.' }}
                </p>
            </div>
        </div>

        {{-- Informasi Utama --}}
        <div class="grid grid-cols-2 gap-10 mt-6 text-lg">
            <div class="space-y-2">
                <p><span class="font-semibold text-gray-800">User ID</span><br>{{ $pelamar->user_id }}</p>
                <p><span class="font-semibold text-gray-800">Nama Lengkap</span><br>{{ $pelamar->nama_pelamar }}</p>
                <p><span class="font-semibold text-gray-800">Alamat</span><br>{{ $pelamar->alamat }}</p>
                <p><span class="font-semibold text-gray-800">No. Telepon</span><br>{{ $pelamar->teleponPelamar }}</p>
            </div>
            <div class="space-y-2">
                <p><span class="font-semibold text-gray-800">Username</span><br>{{ $pelamar->user->username }}</p>
                <p><span class="font-semibold text-gray-800">Email</span><br>{{ $pelamar->user->email }}</p>
                <p><span class="font-semibold text-gray-800">Gender</span><br>{{ ucfirst($pelamar->gender) }}</p>
                <p><span
                        class="font-semibold text-gray-800">Keahlian</span><br>{{ optional($pelamar->skills->first())->skill ?? '-' }}
                </p>
            </div>
        </div>

        {{-- Social Media --}}
        <div class="mt-5">
            <h3 class="font-semibold text-xl text-gray-900 mb-2 pb-1">Social Media</h3>
            <div class="grid grid-cols-6 text-lg space-y-1">
                <div>
                    <p>Instagram</p>
                    <p>LinkedIn</p>
                    <p>Website</p>
                    <p>Twitter</p>
                </div>
                <div>
                    <p>: {{ $pelamar->socialMediaPelamar->instagram ?? '-' }}</p>
                    <p>: {{ $pelamar->socialMediaPelamar->linkedin ?? '-' }}</p>
                    <p>: {{ $pelamar->socialMediaPelamar->website ?? '-' }}</p>
                    <p>: {{ $pelamar->socialMediaPelamar->twitter ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Organisasi --}}
        <div class="mt-5">
            <h3 class="font-semibold text-xl text-gray-900 mb-2 pb-1">Organisasi</h3>
            <ol class="list-decimal list-inside text-lg space-y-1">
                @php($no = 1)
                @forelse ($pelamar->pengalamanOrganisasis as $org)
                    <li class="grid grid-cols-4">

                        <span class="ml-2"> {{$no++}}. {{ $org->nama_organisasi }}</span>
                        <span class="ml-2">{{ $org->jabatan }}</span>
                        <span class="ml-2">{{ $org->tahun_awal }}-{{ $org->tahun_akhir }}</span>
                    </li>
                @empty
                    <p class="text-gray-500 italic">Tidak ada data organisasi.</p>
                @endforelse
            </ol>
        </div>

        {{-- Pengalaman Kerja --}}
        <div class="mt-5">
            <h3 class="font-semibold text-xl text-gray-900 mb-2 pb-1">Pengalaman Kerja</h3>
            <ol class="list-decimal list-inside text-lg space-y-1">
                @php($no = 1)
                @forelse ($pelamar->pengalamanKerjas as $exp)
                    <li class="grid grid-cols-4">
                        <span class="ml-2"> {{$no++}}. {{ $exp->posisi_pekerjaan }}</span>
                        <span class="ml-2">{{ $exp->nama_perusahaan }}</span>
                        <span class="ml-2">{{ $exp->tahun_awal }}-{{ $exp->tahun_akhir }}</span>
                    </li>
                @empty
                    <p class="text-gray-500 italic">Tidak ada pengalaman kerja.</p>
                @endforelse
            </ol>
        </div>

        {{-- Riwayat Pendidikan --}}
        <div class="mt-5">
            <h3 class="font-semibold text-xl text-gray-900 mb-2 pb-1">Riwayat Pendidikan</h3>
            <ol class="list-decimal list-inside text-lg space-y-1">
                @php($no = 1)
                @forelse ($pelamar->riwayatPendidikans as $edu)

                    <li class="grid grid-cols-3">
                        <span class="ml-2"> {{$no++}}. {{ $edu->pendidikan }}</span>
                        <span class="ml-2">{{ $edu->jurusan }}</span>
                        <span class="ml-2">{{ $edu->tahun_awal }}-{{ $exp->tahun_akhir }}</span>
                    </li>

                @empty
                    <p class="text-gray-500 italic">Tidak ada data pendidikan.</p>
                @endforelse
            </ol>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col items-center gap-3 mt-12">
            <a href="{{ route('pelamar.edit', $pelamar->id)}}"
                class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-6 py-2 rounded-md shadow-sm transition w-86 text-center">
                Edit
            </a>
            <a href="{{ route('cv.download', $pelamar->id) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md shadow-sm transition w-86 text-center">
                Unduh
            </a>
            <form action="{{ route('pelamar.destroy', $pelamar->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow-sm transition w-86">
                    Hapus
                </button>
            </form>
        </div>

        <h2 class="text-center font-semibold text-xl my-30">Curriculum Vitae</h2>
        <div class="flex justify-center">
            <a href="{{ route('cv.index')}}" class="relative group">
                <!-- Thumbnail CV -->
                <img src="{{ asset('storage/image.png') }}" alt="CV Preview"
                    class="w-120 shadow-md border border-gray-300 rounded-lg transition-transform duration-300 group-hover:scale-105">

                <!-- Overlay saat hover -->
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <span class="text-white font-medium">Klik untuk melihat CV</span>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection