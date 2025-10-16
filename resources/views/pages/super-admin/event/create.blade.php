@extends('layouts.dashboard')
@section('title', 'Tambah Kandidat')


@section('content')
    <div class="p-6">
        <form action="{{ route('event.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('POST')

            <!-- Judul Artikel -->
            <input type="text" name="title" placeholder="Masukkan judul artikel"
                class="w-full px-4 py-2 border bg-gray-200 hover:bg-gray-300 text-black border-black rounded-md focus:ring-orange-500 focus:border-orange-500">

            <label
                class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-black text-sm font-semibold rounded-md shadow">
                <input type="file" name="image" class="hidden">
                Tambahkan Media
            </label>

            <!-- TinyMCE -->
            <textarea name="content" id="editor" placeholder="Tulis artikelmu di sini..."></textarea>

            <!-- Waktu Acara -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3 items-center">
                <!-- Kolom Tanggal -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Tanggal</label>
                    <input type="date" name="tgl_mulai"
                        class="w-11/12 border rounded-md px-3 py-2 bg-gray-200 hover:bg-gray-300">
                </div>

                <!-- Kolom Jam (Mulai - Sampai - Selesai) -->
                <div class="flex items-center gap-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium">Mulai</label>
                        <input type="time" name="jam_mulai"
                            class="border rounded-md px-3 py-2 bg-gray-200 hover:bg-gray-300">
                    </div>

                    <div class="mt-6">
                        <span class="text-gray-600">Sampai</span>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Selesai</label>
                        <input type="time" name="jam_akhir"
                            class="border rounded-md px-3 py-2 bg-gray-200 hover:bg-gray-300">
                    </div>
                </div>
            </div>


            <!-- Penutupan Pendaftaran -->
            <div>
                <label class="block mb-1 text-sm font-medium">Penutupan Pendaftaran</label>
                <input type="date" name="penutupan_pendaftaran"
                    class=" w-1/7 border rounded-md px-3 py-2 bg-gray-200 hover:bg-gray-300">
            </div>

            <!-- Kuota -->
            <div>
                <label class="block mb-1 text-sm font-medium">Kuota Partisipasi</label>
                <input type="text" name="kuota"
                    class="w-1/10 border rounded-md px-3 py-1 text-center text-black bg-gray-200 hover:bg-gray-300"
                    placeholder="000">
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block mb-1 text-sm font-medium">Lokasi</label>
                <textarea name="lokasi" rows="4" class="w-2/5 border rounded-md px-3 py-2 bg-gray-200 hover:bg-gray-300"
                    placeholder="Isi detail alamat acara"></textarea>
            </div>

            <!-- Daftar Kegiatan -->
            <div x-data="{ kegiatan: [{ jam: '', isi: '' }] }">
                <label class="block mb-2 text-sm font-medium">Daftar Kegiatan</label>

                <template x-for="(row, index) in kegiatan" :key="index">
                    <div class="flex gap-3 mb-2 ">
                        <input type="time" x-model="row.jam" :name="`kegiatan[${index}][jam]`"
                            class="border rounded-md px-3 py-2 w-1/6 text-center bg-gray-200 hover:bg-gray-300">
                        <input type="text" x-model="row.isi" :name="`kegiatan[${index}][isi]`"
                            class="border rounded-md px-3 py-2 w-1/3 bg-gray-200 hover:bg-gray-300"
                            placeholder="Isi Kegiatan">
                        <button type="button" @click="kegiatan.splice(index,1)"
                            class="px-3 py-2 bg-red-500 text-white rounded-md">X</button>
                    </div>
                </template>

                <button type="button" @click="kegiatan.push({ jam: '', isi: '' })"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow">
                    Tambah Acara
                </button>
            </div>

            <!-- Tombol Simpan -->
            <div>
                <button type="submit" class="px-12 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Load TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/4xgohecixlbrqcokrtl9p9onbssj57ho2lh3fhzl1spnln10/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

    <script>
        tinymce.init({
            selector: '#editor',
            height: 350,
            menubar: false,
            plugins: 'advlist autolink lists link image charmap preview anchor ' +
                'searchreplace visualblocks code fullscreen ' +
                'insertdatetime media table code help wordcount',
            toolbar: 'undo redo | formatselect | ' +
                'bold italic underline | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help | link',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection