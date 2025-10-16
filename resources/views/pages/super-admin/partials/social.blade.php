@extends('layouts.dashboard')

@section('title', 'Image Header Social Media')

@section('content')
    <div class="p-6 space-y-8">

        <!-- ===== SOCIAL MEDIA ===== -->
        <div class="bg-orange-500 px-24 pt-3 pb-15 rounded-xl shadow-md">
            <h2 class="text-white font-bold text-lg mb-4">Social Media</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-white font-semibold block mb-1">Facebook</label>
                    <input type="text" name="facebook"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">YouTube</label>
                    <input type="text" name="youtube"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Instagram</label>
                    <input type="text" name="instagram"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">LinkedIn</label>
                    <input type="text" name="linkedin"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
            </div>
        </div>

        <!-- ===== IMAGE HEADER ===== -->
        <div class="bg-orange-500 px-24 pt-3 pb-12 rounded-xl shadow-md">
            <h2 class="text-white font-bold text-lg mb-4">Image Header</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-white font-semibold block mb-1">Beranda</label>
                    <input type="text" name="beranda"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Tips Kerja</label>
                    <input type="text" name="tips_kerja"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Pasang Lowongan</label>
                    <input type="text" name="pasang_lowongan"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Daftar Kandidat</label>
                    <input type="text" name="daftar_kandidat"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Talent Hunter</label>
                    <input type="text" name="talent_hunter"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Profil Pelamar</label>
                    <input type="text" name="profil_pelamar"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Lowongan Tersimpan</label>
                    <input type="text" name="lowongan_tersimpan"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">FAQ</label>
                    <input type="text" name="faq"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Rekrut Pelamar</label>
                    <input type="text" name="rekrut_pelamar"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Pelamar Perusahaan</label>
                    <input type="text" name="pelamar_perusahaan"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Kandidat AK</label>
                    <input type="text" name="kandidat_ak"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Berlangganan</label>
                    <input type="text" name="berlangganan"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
                <div>
                    <label class="text-white font-semibold block mb-1">Request Data</label>
                    <input type="text" name="request_data"
                        class="w-full px-4 py-2 rounded-md border-none bg-white focus:ring-2 focus:ring-orange-300">
                </div>
            </div>
        </div>

    </div>
@endsection