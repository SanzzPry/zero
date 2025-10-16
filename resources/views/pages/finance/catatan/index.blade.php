@extends('layouts.finance')

@section('title', 'Catatan Transaksi')

@section('content')
<div class="px-6 py-6">

    <h2 class="text-lg font-semibold mb-3">Riwayat Tunai</h2>
    <div class="bg-white mb-5 border border-gray-300 rounded-xl shadow overflow-hidden">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-orange-500 text-white text-left">
                    <th class="px-4 py-2 text-center">NO</th>
                    <th class="px-4 py-2 text-center">No. Referensi</th>
                    <th class="px-4 py-2 text-center">Jenis</th>
                    <th class="px-4 py-2 text-center">Dari</th>
                    <th class="px-4 py-2 text-center">Sumber Dana</th>
                    <th class="px-4 py-2 text-center">Total Tunai</th>
                    <th class="px-4 py-2 text-center">Detail</th>
                    <th class="px-4 py-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach ($cashes as $cash)

                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $no++ }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $cash->no_referensi }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $cash->jenis }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $cash->dari }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $cash->sumber_dana }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">Rp
                            {{ number_format($cash->total, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400 space-x-1">
                            <a href="{{ route('catatan.show', $cash->id) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                        </td>

                        <td
                            class="px-4 py-2 text-center border-t-1 border-gray-400
                                                                                                    {{ $cash->status === 'sukses' ? 'text-green-500' : ($cash->status === 'gagal' ? 'text-red-500' : '') }}">
                            {{ $cash->status }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="text-lg font-semibold mb-3">Riwayat Koin</h2>
    <div class="bg-white border border-gray-300 rounded-xl shadow overflow-hidden">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-orange-500 text-white text-left">
                    <th class="px-4 py-2 text-center">NO</th>
                    <th class="px-4 py-2 text-center">No. Referensi</th>
                    <th class="px-4 py-2 text-center">Jenis</th>
                    <th class="px-4 py-2 text-center">Dari</th>
                    <th class="px-4 py-2 text-center">Sumber Dana</th>
                    <th class="px-4 py-2 text-center">Total Koin</th>
                    <th class="px-4 py-2 text-center">Detail</th>
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
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->sumber_dana }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400">{{ $koin->total }}</td>
                        <td class="px-4 py-2 text-center border-t-1 border-gray-400 space-x-1">
                            <a href="{{ route('catatank.show', $koin->id) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                        </td>
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