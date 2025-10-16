@extends('layouts.dashboard')
@section('title', 'Detail Tips')

@section('content')
    <div class="px-7 py-6">

        <a href="{{ route('tips.index') }}"
            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow mb-4 inline-block">
            Kembali
        </a>

        <div class="bg-white shadow rounded-lg p-6">
            <!-- Judul -->
            <h1 class="text-2xl font-bold mb-3">{{ $tip->title }}</h1>

            <!-- Penulis & Tanggal -->
            <p class="text-sm text-gray-500 mb-4">
                Ditulis oleh <span class="font-semibold">{{ $tip->penulis }}</span> pada
                {{ $tip->created_at->format('d/m/Y') }}
            </p>

            {{-- @if($tip->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/tips_images/' . $tip->image) }}" alt="{{ $tip->title }}"
            class="w-full rounded-md shadow">
        </div>
        @endif --}}

        <!-- Konten -->
        <div class="prose max-w-none">
            {!! $tip->content !!}
        </div>
    </div>

    </div>
@endsection