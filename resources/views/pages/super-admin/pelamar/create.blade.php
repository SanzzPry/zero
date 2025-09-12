@extends('layouts.dashboard')
@section('title', 'Tambah Kandidat')

@section('content')
    <div class="px-7 py-2">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="bg-white border rounded-xl px-18 py-5">
                <h2 class="text-xl font-bold mb-5">Edit Profile</h2>

                <!-- Header Profile -->
                <div class="flex items-center mb-8">
                    <img id="profile-preview"
                        src="{{ old('photo') ? asset('storage/' . old('photo')) : 'https://ui-avatars.com/api/?name=' . '&background=random' }}"
                        alt="Profile Photo"
                        class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                    <div>
                        <!-- Upload -->
                        <div class="ml-8 mt-1 space-x-2">
                            <label
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                                <input type="file" name="photo" class="hidden">
                                Upload
                            </label>
                            <button type="submit" name="remove_photo" value="1"
                                class="px-3 py-1  bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                                Remove Photo
                            </button>
                        </div>
                    </div>
                </div>
                <div class=" space-y-3">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div class="text-center p-2 flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow">
                            Save
                        </button>
                        <a href="{{ route('pelamar.index') }}"
                            class="px-8 py-2 bg-white border border-orange-500 text-orange-500 font-semibold rounded-md shadow hover:bg-orange-50">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection