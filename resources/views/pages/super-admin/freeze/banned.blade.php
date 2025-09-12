@extends('layouts.dashboard')
@section('title', 'Akun Freeze')

@section('content')
    <div class="px-24 py-8">
        <!-- Card Utama -->
        <div class="bg-white border rounded-xl shadow-md overflow-hidden">

            <!-- Header: Foto + Tombol -->
            <div class="flex items-center justify-between px-10 py-6 border-b rounded-xl shadow-md/20">
                <!-- Foto -->
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=random' }}"
                    alt="Profile" class="w-24 h-24 rounded-full object-cover border">

                <!-- Tombol (posisi ketengah) -->
                <div class="flex-1 flex justify-center gap-3">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">Unbanned</button>
                    <form action="{{ route('akun.destroy', $user->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">Hapus
                            Akun</button>
                    </form>
                </div>
            </div>


            <!-- Info Section -->
            <div class="px-14 py-10 space-y-6">
                <!-- Row 1 -->
                <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700 font-medium">
                    Has been exploited with Am
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-14">
                    <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                        {{ $user->username }}
                    </div>
                    <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                        {{ $user->email }}
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                    {{ $user->address_detail ?? '-' }}
                </div>

                <!-- Row 4 -->
                <div class="bg-gray-200 rounded-md h-50 p-3 text-gray-700 overflow-auto">
                </div>
            </div>
        </div>
    </div>
@endsection
