@extends('layouts.finance')

@section('title', 'Omset Perusahaan')

@section('content')
    <div class="px-24 py-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Tampilkan Omset Perusahaan</h2>

            <form action="{{ route('omset.index') }}" method="GET" class="flex items-center gap-3">
                <select name="bulan" id="filter"
                    class="px-4 py-2 bg-white text-orange-500 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-300">
                    <option value="">Bulan</option>
                    <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                </select>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                    Cari
                </button>
            </form>
        </div>

        <div class="bg-white border border-gray-300 rounded-xl shadow overflow-hidden">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-orange-500 text-white text-left">
                        <th class="px-4 py-2 text-center" colspan="2">Daftar Omset Perusahaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-12 py-2 text-left border-t">
                                {{ $transaksi->created_at->translatedFormat('F Y') }}
                            </td>
                            <td class="px-12 py-2 text-right border-t">
                                Rp{{ number_format($transaksi->tunai, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">Tidak ada data untuk bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transaksis->count() > 0)
            <div class="mt-4 grid grid-cols-[auto_1fr] gap-x-1 gap-y-2 text-gray-700 border-b-2 pb-4 border-orange-400">
                <div>Total Omset </div>
                <div>: Rp {{ number_format($totalOmset, 2, ',', '.') }}</div>

                <div>Rata-rata </div>
                <div>: Rp {{ number_format($rataRata, 2, ',', '.') }}</div>
            </div>
        @endif

        <div class="flex justify-between items-center mt-5">
            <a href="{{ route('omset.download', request()->all()) }}"
                class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-lg shadow">
                Unduh
            </a>
        </div>
    </div>
@endsection