@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 m-4">
        <!-- Card: Pelamar -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Pelamar</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">27</span>
                <span class="ml-2 text-sm font-medium text-green-600">+1.3%</span>
            </div>
            <a href="#" class="mt-3 inline-block text-sm font-medium text-emerald-600 hover:underline">
                Lihat Detail &gt;
            </a>
        </div>

        <!-- Card: Perusahaan -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Perusahaan</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">15</span>
                <span class="ml-2 text-sm font-medium text-green-600">+2.3%</span>
            </div>
            <a href="#" class="mt-3 inline-block text-sm font-medium text-emerald-600 hover:underline">
                Lihat Detail &gt;
            </a>
        </div>

        <!-- Card: Admin -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Admin</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">14</span>
                <span class="ml-2 text-sm font-medium text-green-600">+0.7%</span>
            </div>
            <a href="#" class="mt-3 inline-block text-sm font-medium text-emerald-600 hover:underline">
                Lihat Detail &gt;
            </a>
        </div>

        <!-- Card: Super Admin -->
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-600">Super Admin</h3>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-gray-900">37</span>
                <span class="ml-2 text-sm font-medium text-green-600">+5.3%</span>
            </div>
            <a href="#" class="mt-3 inline-block text-sm font-medium text-emerald-600 hover:underline">
                Lihat Detail &gt;
            </a>
        </div>
    </div>

@endsection