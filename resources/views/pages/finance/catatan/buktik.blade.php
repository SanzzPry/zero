@extends('layouts.finance')
@section('title', 'Bukti Transaksi')

@section('content')
    <div class="mt-6 text-center">
        <a href="{{ route('catatan.index') }}" class="text-orange-500 hover:underline">← Kembali</a>
    </div>
    <div class="px-6 py-6 flex justify-center">
        <div class="bg-white w-[400px] rounded-3xl shadow-2xl p-8 border border-gray-200">
            <h2 class="text-xl font-semibold text-center mb-6">Top Up Berhasil</h2>

            <div class="flex justify-center mb-6">
                <div class="relative w-16 h-16 flex items-center justify-center">
                    <!-- Lingkaran luar -->
                    <div class="absolute inset-0 bg-orange-100 rounded-full"></div>

                    <!-- Lingkaran dalam -->
                    <div class="absolute inset-[6px] bg-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check text-white text-2xl"></i>
                    </div>
                </div>
            </div>


            <div class="text-sm space-y-3 border-b-1">
                <div class="flex justify-between">
                    <span class="text-gray-600">No.Transaksi</span>
                    <span class="font-medium">{{ $koins->no_referensi }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Status</span>
                    <span
                        class="bg-orange-500 text-white px-3 py-1 rounded-md text-xs font-semibold">{{ ucfirst($koins->status) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jenis Transaksi</span>
                    <span>{{ $koins->jenis }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Nama Pengirim</span>
                    <span>{{ $koins->dari }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Nama Penerima</span>
                    <span>Area Kerja</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Metode Pembayaran</span>
                    <span>{{ $koins->sumber_dana }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tgl/Waktu</span>
                    <span>{{ \Carbon\Carbon::parse($koins->created_at)->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Nominal</span>
                    <span>{{ number_format($koins->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between pb-3">
                    <span class="text-gray-600">Biaya Admin</span>
                    <span>{{ number_format($koins->biayaadmin, 0, ',', '.')  }}</span>
                </div>
            </div>
            <div class="flex justify-between pt-3 border-t border-dashed border-gray-300 mt-2">
                <span class="text-gray-600 font-semibold">Total Pembayaran</span>
                <span class="font-semibold">
                    {{ number_format($koins->total + $koins->biayaadmin, 0, ',', '.') }}
                </span>
            </div>


            <div class="flex flex-col items-center mt-10">
                <img src="{{ ('/images/logo-orange.svg') }}" alt="Logo" class="w-12 mb-1">
                <p class="text-xs text-gray-400">Copyright ©2025 areakerja.com</p>
            </div>

        </div>

    </div>
@endsection