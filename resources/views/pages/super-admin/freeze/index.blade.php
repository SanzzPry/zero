@extends('layouts.dashboard')
@section('title', 'Akun Freeze')

@section('content')
<div class="px-8 py-6">

    <!-- Form Pencarian -->
    <div class="flex justify-end mb-6">
        <form action="{{ route('freeze.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="nama/kategori ..."
                class="w-64 px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">

            <button type="submit"
                class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                Cari
            </button>
        </form>
    </div>

    <!-- Tabel -->
    <div class="bg-white border border-gray-300 rounded-xl shadow overflow-hidden">
        <div class="px-5">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="text-center">
                        <th class="px-6 pt-6 pb-12">NO</th>
                        <th class="px-6 pt-6 pb-12">Nama</th>
                        <th class="px-6 pt-6 pb-12">Kategori</th>
                        <th class="px-6 pt-6 pb-12">Telepon</th>
                        <th class="px-6 pt-6 pb-12">Alamat</th>
                        <th class="px-6 pt-6 pb-12">Status</th>
                        <th class="px-6 pt-6 pb-12">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($pelamars as $user)
                        <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                            <td class="px-4 py-2">{{ $no++ }}</td>
                            <td class="px-4 py-2">{{ $user->nama_pelamar }}</td>
                            <td class="px-4 py-2">{{ $user->kategori ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $user->teleponPelamar ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $user->alamat ?? '-' }}</td>
                            <td class="px-4 py-2"><span
                                    class="{{ $user->status == 'unbanned' ? 'bg-green-600 hover:bg-green-700' : 'bg-yellow-600 hover:bg-yellow-700' }} text-white px-5 py-2 rounded-lg">
                                    {{ $user->status == 'unbanned' ? 'Unbanned' : 'Banned' }}</span></td>
                            <td class="px-4 py-2 space-x-1">
                                <!-- Tombol Aksi -->
                                <a href="{{ route('freeze.show', $user->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
        </table>
    </div>
</div>
@endsection