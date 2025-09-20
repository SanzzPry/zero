@extends('layouts.dashboard')
@section('title', 'Event')
@section('content')
    <div class="px-8 py-6">

        {{-- Overlay Pesan --}}
        @if (session('success'))
            <div id="alert-overlay" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="flex items-center gap-3 bg-white px-6 py-4 rounded-lg shadow-lg relative">

                    <!-- Icon -->
                    <div class="bg-green-500 rounded-full p-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Pesan -->
                    <p class="text-gray-800 font-medium">{{ session('success') }}</p>

                    <!-- Tombol Close -->
                    <button onclick="document.getElementById('alert-overlay').remove()"
                        class="absolute -top-2 -right-2 bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center text-gray-600 hover:text-gray-800">
                        &times;
                    </button>
                </div>
            </div>
        @endif


        <div class="flex justify-between ml-4 mb-6">
            <div>
                <a href="{{ route('event.create') }}"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg shadow">
                    Buat Post
                </a>
            </div>
            <form action="{{ route('event.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="cari event"
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
                            <th class="px-6 pt-6 pb-12">Status</th>
                            <th class="px-6 pt-6 pb-12">Nama</th>
                            <th class="px-6 pt-6 pb-12">Pendaftaran</th>
                            <th class="px-6 pt-6 pb-12">Quota</th>
                            <th class="px-6 pt-6 pb-12">Mulai</th>
                            <th class="px-6 pt-6 pb-12">Selesai</th>
                            <th class="px-6 pt-6 pb-12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="hover:bg-gray-50 border-b-2 rounded-xl border-gray-300 text-center">
                                <td class="px-4 py-2">
                                    <a
                                        class="px-4 py-1.5 text-sm rounded-md {{ $event->status == 'buka' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ $event->status }}
                                    </a>
                                </td>
                                <td class="px-4 py-2"><a href="{{route('event.show', $event->id)}}"
                                        class="inline-flex items-center justify-center text-blue-600 hover:underline rounded-md ">
                                        {{ $event->title}}
                                    </a></td>
                                <td class="px-4 py-2">{{ $event->pendaftaran ?? '0' }}</td>
                                <td class="px-4 py-2">{{ $event->kuota }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($event->tgl_mulai . ' ' . $event->jam_mulai)->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($event->tgl_mulai . ' ' . $event->jam_akhir)->format('d M Y H:i') }}
                                </td>

                                <td class="px-4 py-2 space-x-1">
                                    <!-- Tombol Aksi -->
                                    <form id="deleteForm" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            class="delete-btn inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white"
                                            data-id="{{ $event->id }}">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if(isset($event))
        <!-- Modal Hapus -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center hidden">
            <div
                class="bg-white rounded-xl shadow-lg p-32 w-140 transform transition-all scale-95 opacity-0 duration-300 text-center">

                <p class="text-sm text-gray-600 mb-5">Apakah kamu yakin ingin menghapus event ini?</p>
                <div class="flex justify-center gap-3">
                    <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">Hapus</button>
                    </form>
                    <button id="cancelDelete" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">Batal</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        const deleteBtns = document.querySelectorAll('.delete-btn');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const cancelDelete = document.getElementById('cancelDelete');
        const modalBox = deleteModal.querySelector('div');


        deleteBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const userId = btn.dataset.id;
                deleteForm.action = `/event/${userId}`;
                deleteModal.classList.remove('hidden');
                setTimeout(() => {
                    modalBox.classList.remove('scale-95', 'opacity-0');
                    modalBox.classList.add('scale-100', 'opacity-100');
                }, 50);
            });
        });

        cancelDelete.addEventListener('click', () => {
            modalBox.classList.add('scale-95', 'opacity-0');
            modalBox.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => deleteModal.classList.add('hidden'), 200);
        });
    </script>

@endsection