@extends('layouts.dashboard')
@section('title', 'Data Kandidat')

@section('content')
    <div class="px-8 py-6">

        <div class="flex justify-between mb-6">
            <div>
                <a href="{{ route('pelamar.create') }}"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    +
                </a>
                <!-- Tombol Filter (toggle sort) -->
                <a href="{{ route('pelamar.index', ['sort' => request('sort') === 'oldest' ? 'latest' : 'oldest']) }}"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    ^
                </a>
                <form method="GET" action="{{ route('pelamar.index') }}" class="inline-block">
                    <select name="kategori" onchange="this.form.submit()"
                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg shadow">
                        <option value="">Semua Status</option>
                        <option value="kandidat aktif" {{ request('kategori') == 'kandidat aktif' ? 'selected' : '' }}>
                            Kandidat
                        </option>
                        <option value="kandidat nonaktif" {{ request('kategori') == 'kandidat nonaktif' ? 'selected' : '' }}>
                            Non
                            Kandidat
                        </option>
                        <option value="calon kandidat" {{ request('kategori') == 'calon kandidat' ? 'selected' : '' }}>Calon
                            Kandidat
                        </option>
                    </select>
                </form>
            </div>
            <form action="{{ route('pelamar.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="nama/username ..."
                    class="w-64 px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">

                <button type="submit"
                    class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    Cari
                </button>
            </form>
        </div>

        <!-- Tabel -->
        <div class="bg-white border border-gray-300 rounded-3xl shadow overflow-hidden">
            <div class="px-5">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-center">
                            <th class="px-6 pt-6 pb-12">ID</th>
                            <th class="px-6 pt-6 pb-12">Nama</th>
                            <th class="px-6 pt-6 pb-12">Pendidikan</th>
                            <th class="px-6 pt-6 pb-12">Skill</th>
                            <th class="px-6 pt-6 pb-12">Alamat</th>
                            <th class="px-6 pt-6 pb-12">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                                <td class="px-4 py-2">{{ $user->id}}</td>
                                <td class="px-4 py-2">{{ $user->nama_pelamar }}</td>
                                <td class="px-4 py-2">
                                    @if ($user->riwayatPendidikans->isNotEmpty())
                                        <span>{{ $user->riwayatPendidikans->first()->pendidikan }}
                                            ({{ $user->riwayatPendidikans->first()->jurusan }})</span>
                                    @endif
                                </td>

                                <td class="px-4 py-2">
                                    {{ optional($user->skills->first())->skill ?? '-' }}
                                </td>

                                <td class="px-4 py-2">{{ $user->alamat ?? '-' }}</td>
                                <td class="px-4 py-2 space-x-1">
                                    <!-- Tombol Aksi -->
                                    @php
                                        $kategori = request('kategori');
                                    @endphp

                                    <a href="{{ $kategori === 'calon kandidat' ? route('kandidatToPelamar.index', $user->id) : route('pelamar.show', $user->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection