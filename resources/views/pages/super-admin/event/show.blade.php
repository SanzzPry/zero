@extends('layouts.dashboard')
@section('title', 'Detail Event')
@section('content')

    <div class="px-8 py-6">

        <!-- Header Status & Tombol -->
        <div class="flex justify-end items-center mb-4 gap-4">
            <div class="flex items-center space-x-2">
                <label for="">Status</label>
                <div x-data="{
                                                        status: '{{ $event->status }}',
                                                        toggleStatus() {
                                                            axios.patch('{{ route('event.toggleStatus', $event->id) }}')
                                                                .then(res => {
                                                                    this.status = res.data.status
                                                                })
                                                                .catch(err => console.error(err));
                                                        }
                                                    }">
                    <button @click="toggleStatus"
                        :class="status == 'buka' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'"
                        class="px-4 py-1.5 text-sm rounded-md">
                        <span x-text="status"></span>
                    </button>
                </div>
            </div>
            <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                onsubmit="return confirm('Yakin hapus event ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-11 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md">
                    Hapus
                </button>
            </form>
        </div>
        <div class="flex justify-end">
            <div class="flex space-x-4">
                <a href="{{ route('event.edit', $event->id)}}"
                    class="px-9 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md">
                    Edit Event
                </a>
                <a href="{{ route('event.partisipan', $event->id)}}"
                    class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md">
                    Lihat Partisipan
                </a>
                <a href="{{route('event.index')}}"
                    class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md">
                    <- Kembali </a>
            </div>
        </div>

        <!-- Tanggal -->
        <p class="text-black text-xl font-semibold mb-2">{{ \Carbon\Carbon::parse($event->created_at)->format('d F Y') }}
        </p>

        <!-- Gambar -->
        <div class="mb-6">
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                class="rounded-xl w-full max-h-96 object-cover">
        </div>

        <!-- Deskripsi -->
        <h2 class="text-lg font-semibold mb-2">{{ $event->title }}</h2>
        <div class="prose max-w-none">
            {!! $event->content !!}
        </div>
        <br><br>
        <!-- Detail Acara -->
        <div class="mb-6">
            <h3 class="text-orange-600 font-semibold mb-2">Detail acara</h3>
            <p class="flex items-center text-gray-700 mb-1">
                <i class="far fa-clock mr-2 text-orange-500"></i>
                Waktu: {{ \Carbon\Carbon::parse($event->tgl_mulai . ' ' . $event->jam_mulai)->format('d F Y (H.i') }} -
                {{ \Carbon\Carbon::parse($event->tgl_akhir . ' ' . $event->jam_akhir)->format('H.i)') }} WIB
            </p>
            <p class="flex items-center text-gray-700">
                <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
                Lokasi: {{ $event->lokasi }}
            </p>
        </div>

        <!-- Daftar Kegiatan -->
        <h3 class="text-gray-800 font-semibold mb-2">Daftar kegiatan:</h3>
        <div class="overflow-x-auto">
            <table class="w-full border border-orange-400  overflow-hidden">
                <thead>
                    <tr class="bg-orange-50 text-orange-600">
                        <th class="px-4 py-2 border border-orange-400">Waktu</th>
                        <th class="px-4 py-2 border border-orange-400">Acara</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($event->kegiatanEvent as $kegiatan)
                        <tr>
                            <td class="px-4 py-2 border border-orange-400 text-center">
                                {{ $kegiatan->waktu }}
                            </td>
                            <td class="px-4 py-2 border border-orange-400 text-center">
                                {{ $kegiatan->kegiatan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection