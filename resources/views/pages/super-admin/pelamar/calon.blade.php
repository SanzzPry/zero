@extends('layouts.dashboard')
@section('title', 'Data Kandidat')

@section('content')
    <div class="px-8 py-6">
        <h1 class="text-xl font-bold mb-6">Data Kandidat</h1>

        {{-- Bagian tombol Lulus / Gugur --}}
        <div class="bg-orange-500 rounded-2xl p-8 text-white shadow-lg flex flex-col items-center mb-10">
            <img src="{{ $user->img_profile ? asset('storage/' . $user->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama_pelamar) . '&background=random' }}"
                alt="Profile" class="w-28 h-28 rounded-full border-4 border-white shadow-md mb-4 object-cover">
            <h2 class="text-2xl font-bold mb-3">{{ $user->nama_pelamar }}</h2>

            <p class="text-center mb-6">Pilih hasil seleksi untuk kandidat ini:</p>

            <div class="flex gap-6">
                {{-- Tombol Lulus --}}
                <form action="{{ route('kandidatToPelamar.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="kategori" value="kandidat aktif">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        Lulus
                    </button>
                </form>

                {{-- Tombol Gugur --}}
                <form action="{{ route('kandidatToPelamar.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="kategori" value="kandidat nonaktif">
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        Gugur
                    </button>
                </form>
            </div>
        </div>

        {{-- Form data pelatihan --}}
        <div class="bg-orange-500 rounded-2xl p-8 text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Data Pelatihan Kandidat</h2>

            <form action="{{ route('kandidatToPelamar.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-6">
                    <img src="{{ $user->img_profile ? asset('storage/' . $user->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama_pelamar) . '&background=random' }}"
                        alt="Profile" class="w-28 h-28 rounded-full border-4 border-white shadow-md object-cover">
                    <input type="text" name="nama_pelamar" value="{{ $user->nama_pelamar }}"
                        class="flex-1 px-4 py-2 rounded-md border bg-white border-gray-300 text-black focus:ring-2 focus:ring-orange-300"
                        readonly>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-6">
                    <div>
                        <label class="block text-white font-semibold mb-1">Divisi</label>
                        <input type="text" name="divisi" value="{{ $user->divisi }}" placeholder="Masukkan Divisi"
                            class="w-full px-4 py-2 rounded-md text-black border bg-white border-gray-300 focus:ring-2 focus:ring-orange-300">
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-1">Mulai Pelatihan</label>
                        <input type="date" name="mulai_pelatihan" value="{{ $user->mulai_pelatihan }}"
                            class="w-full px-4 py-2 rounded-md text-black border bg-white border-gray-300 focus:ring-2 focus:ring-orange-300">
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-1">Selesai Pelatihan</label>
                        <input type="date" name="selesai_pelatihan" value="{{ $user->selesai_pelatihan }}"
                            class="w-full px-4 py-2 rounded-md text-black border bg-white border-gray-300 focus:ring-2 focus:ring-orange-300">
                    </div>
                </div>

                <div class="flex gap-6 mt-8 justify-center">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        Simpan
                    </button>
                    <a href="{{ route('pelamar.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
