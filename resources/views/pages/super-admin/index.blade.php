@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 m-4">
        <!-- Card: Pelamar -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Pelamar</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">{{ $pelamar }}</span>
            </div>
        </div>

        <!-- Card: Super Admin -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Super Admin</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">{{ $superAdmin }}</span>
            </div>
        </div>

        <!-- (opsional, placeholder buat nanti) -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Perusahaan</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">{{ $perusahaan }}</span>
            </div>
        </div>

        <div class="p-5 bg-gray-100 border border-gray-200 rounded-lg shadow-sm text-center text-gray-400">
            <h3 class="text-sm font-medium">Admin</h3>
            <p class="mt-2">Belum ada data</p>
        </div>
    </div>
@endsection