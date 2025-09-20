@extends('layouts.dashboard')
@section('title', 'Data Perusahaan')

@section('content')
    <div class="px-8 py-6">

        <div class="flex justify-between mb-6">
            <div>
                <a href="{{ route('perusahaan.create') }}"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    +
                </a>
                <a href="{{ route('perusahaan.create') }}"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    =
                </a>
                <select name="" id=""
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg shadow">>
                    <option value="">Perusahaan</option>
                    <option value="">Recruitment</option>
                    <option value="">Talent Hunter</option>
                    <option value="">Panggilan</option>
                </select>
            </div>
            <form action="{{ route('freeze.index') }}" method="GET" class="flex space-x-2">
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
                            <th class="px-6 pt-6 pb-12">Nama Perusahaan</th>
                            <th class="px-6 pt-6 pb-12">Email</th>
                            <th class="px-6 pt-6 pb-12">Telepon</th>
                            <th class="px-6 pt-6 pb-12">Alamat</th>
                            <th class="px-6 pt-6 pb-12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user) --}}
                        <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2 space-x-1">
                                <!-- Tombol Aksi -->
                                <a href=""
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
            </div>
            </table>
        </div>
    </div>
@endsection