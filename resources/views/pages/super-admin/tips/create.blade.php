@extends('layouts.dashboard')
@section('title', 'Buat Post Baru')

@section('content')
    <div class="px-7 py-6">
        <!-- Form Buat Tips -->
        <form action="{{ route('tips.store')}}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Judul Artikel -->
            <input type="text" name="title" placeholder="Masukkan judul artikel"
                class="w-full px-4 py-2 border bg-gray-200 hover:bg-gray-300 text-black border-black rounded-md focus:ring-orange-500 focus:border-orange-500">

            <label
                class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-black text-sm font-semibold rounded-md shadow">
                <input type="file" id="image" name="image" class="hidden" accept="image/*">
                Tambahkan Media
            </label>

            <!-- TinyMCE -->
            <textarea name="content" id="editor" placeholder="Tulis artikelmu di sini..."></textarea>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-4">
                <button type="submit" class="px-5 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
                    Simpan
                </button>
                <a href="{{ route('tips.index') }}"
                    class="px-5 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Load TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/4xgohecixlbrqcokrtl9p9onbssj57ho2lh3fhzl1spnln10/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

    <script>
        tinymce.init({
            selector: '#editor',
            height: 500,
            menubar: false,
            plugins: 'advlist autolink lists link image charmap preview anchor ' +
                'searchreplace visualblocks code fullscreen ' +
                'insertdatetime media table code help wordcount',
            toolbar: 'undo redo | formatselect | ' +
                'bold italic underline | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help | image link',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        // Event untuk upload file langsung masuk ke editor
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    tinymce.activeEditor.insertContent(
                        `<img src="${evt.target.result}" style="max-width:300px; height:auto; display:block; margin:10px auto;" />`
                    );
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection