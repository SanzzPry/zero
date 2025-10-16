@extends('layouts.finance')

@section('title', 'Dashboard')

@section('content')
<div class="px-6 py-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Card Total Omset --}}
        <div class="flex items-center justify-between bg-orange-500 text-white rounded-2xl px-6 py-4 shadow-md">
            <div>
                <p class="text-sm font-semibold">Total Omset</p>
                <p class="text-lg font-bold">Rp {{ number_format($totalOmsetBulanIni, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/20 rounded-full p-3">
                {{-- Ikon grafik naik (trending up) --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17l6-6 4 4 8-8M13 11h8v8" />
                </svg>
            </div>
        </div>

        {{-- Card Total Transaksi Koin --}}
        <div class="flex items-center justify-between bg-orange-500 text-white rounded-2xl px-6 py-4 shadow-md">
            <div>
                <p class="text-sm font-semibold">Total Transaksi Koin</p>
                <p class="text-lg font-bold">{{ number_format($totalKoinBulanIni, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/20 rounded-full p-3">
                {{-- Ikon koin (currency) --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c-4.418 0-8 1.79-8 4v4c0 2.21 3.582 4 8 4s8-1.79 8-4v-4c0-2.21-3.582-4-8-4zM12 8V4m0 16v-4" />
                </svg>
            </div>
        </div>
    </div>


    <h2 class="text-lg font-semibold mb-3 mt-4">Riwayat Koin</h2>
    <div class="bg-white border border-gray-300 rounded-xl shadow overflow-hidden">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-orange-500 text-white text-left">
                    <th class="px-4 py-2 text-center">NO</th>
                    <th class="px-4 py-2 text-center">No. Referensi</th>
                    <th class="px-4 py-2 text-center">Jenis</th>
                    <th class="px-4 py-2 text-center">Dari</th>
                    <th class="px-4 py-2 text-center">Sumber Dana</th>
                    <th class="px-4 py-2 text-center">Tanggal</th>
                    <th class="px-4 py-2 text-center">Total Koin</th>
                    <th class="px-4 py-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach ($koins as $koin)

                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $no++ }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->no_referensi }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->jenis }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->dari }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">
                            {{ $koin->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->sumber_dana }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->total }} koin</td>

                        <td
                            class="px-4 py-2 text-center border-t-1 border-gray-400
                                                                                                                                                                                                {{ $koin->status === 'sukses' ? 'text-green-500' : ($koin->status === 'gagal' ? 'text-red-500' : '') }}">
                            {{ $koin->status }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('closeBukti').addEventListener('click', () => {
        document.getElementById('buktiTransaksiModal').classList.add('hidden');
    });

    // Contoh cara buka modalnya
    // document.getElementById('buktiTransaksiModal').classList.remove('hidden');
</script>
@endsection