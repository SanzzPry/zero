@extends('layouts.dashboard')
@section('title', 'Partisipan Event')

@section('content')
    <div class="px-8 py-6">

        <h2 class="text-2xl font-semibold text-orange-600 mb-6">Daftar Partisipan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- @forelse($partisipans as $p) --}}
            <div class="bg-orange-500 text-white rounded-xl p-4 shadow-md hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-2">{{ $p->nama ?? '-'}}</h3>
                <p class="text-sm"><strong>Telepon:</strong> {{ $p->telepon ?? '-'}}</p>
                <p class="text-sm"><strong>WA:</strong> {{ $p->wa ?? '-'}}</p>
                <p class="text-sm"><strong>Email:</strong> {{ $p->email ?? '-'}}</p>
            </div>
            {{-- @empty --}}
            <p class="text-gray-500 col-span-full">Belum ada partisipan untuk event ini.</p>
            {{-- @endforelse --}}
        </div>
        <br><br>
        <a href="{{ route('event.show', $event->id) }}"
            class="pr-8 pl-6 py-2 bg-white-500 hover:bg-white-700 text-orange-500 font-semibold border-2 border-orange-500 rounded-md shadow">
            <- Kembali </a>
    </div>
@endsection