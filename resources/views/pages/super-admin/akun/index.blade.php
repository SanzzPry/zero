@extends('layouts.dashboard')
@section('title', 'Kelola Akun')

@section('content')
    <div class="px-22 py-6">

        {{-- Overlay Pesan --}}
        @if (session('success'))
            <div id="alert-overlay" class="fixed inset-0 flex items-center justify-center z-50 ">
                <div class="bg-white rounded-xl shadow-xl p-8 w-96 text-center">
                    <p class="text-gray-800 text-lg font-medium">{{ session('success') }}</p>

                    {{-- Pastikan session user_id ada --}}
                    @if (session('user_id'))
                        <a href="{{ route('akun.edit', session('user_id')) }}"
                            class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            Yes
                        </a>
                    @endif

                    <button onclick="document.getElementById('alert-overlay').style.display='none'"
                        class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                        Close
                    </button>
                </div>
            </div>
        @endif





        <!-- Tombol Tambah User -->
        <div class="mb-4">
            <a href="{{ route('akun.create') }}"
                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                Tambah User +
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white border rounded-xl shadow overflow-hidden">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-orange-500 text-white text-left">
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">User</th>
                        <th class="px-4 py-2 text-center">Email</th>
                        <th class="px-4 py-2 text-center">Username</th>
                        <th class="px-4 py-2 text-center">Region</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->role }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->username }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->superAdmin->provinsi ?? '-' }}</td>
                            <td class="px-4 py-2 text-center space-x-1">
                                <!-- Tombol Aksi -->
                                <a href="{{ route('akun.show', $user->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('akun.edit', $user->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form id="deleteForm" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="delete-btn inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white"
                                        data-id="{{ $user->id }}">
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

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div
            class="bg-white rounded-xl shadow-lg p-32 w-140 transform transition-all scale-95 opacity-0 duration-300 text-center">

            <p class="text-sm text-gray-600 mb-5">Apakah kamu yakin ingin menghapus user ini?</p>
            <div class="flex justify-center gap-3">
                <form action="{{ route('akun.destroy', $user->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">Hapus</button>
                </form>
                <button id="cancelDelete" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">Batal</button>
            </div>
        </div>
    </div>


    <script>
        const deleteBtns = document.querySelectorAll('.delete-btn');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const cancelDelete = document.getElementById('cancelDelete');
        const modalBox = deleteModal.querySelector('div');


        deleteBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const userId = btn.dataset.id;
                deleteForm.action = `/akun/${userId}`;
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