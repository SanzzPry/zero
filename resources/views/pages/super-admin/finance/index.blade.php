@extends('layouts.dashboard')
@section('title', 'Paket')

@section('content')
<div class="px-6 py-6">
    {{-- Dropdown Filter --}}
    <div class="mb-6">
        <select id="sectionFilter"
            class="px-4 py-2 border bg-orange-500 hover:bg-orange-600 text-white rounded-lg focus:ring-2 focus:ring-orange-400">
            <option value="paket">Paket Harga</option>
            <option value="riwayat">Riwayat</option>
            <option value="laporan">Laporan</option>
        </select>
    </div>
    <div class="px-24">

        {{-- Paket Harga --}}
        <div id="paket" class="section">
            <div class="flex justify-between mb-2">
                <div>
                    <h2 class="text-lg font-semibold">Paket Harga Koin</h2>
                </div>
                <a onclick="openOverlay('editKoinOverlay')"
                    class="cursor-pointer inline-flex items-center px-6 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-xl shadow">
                    Edit
                </a>
            </div>
            <div class="bg-white border border-gray-300 mb-6 rounded-xl shadow overflow-hidden">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-12 py-3 text-left ">Nama</th>
                            <th class="px-10 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets->where('id', '<=', 6) as $paket)
                            <tr>
                                <td class="border-b border-gray-300 px-8 py-3">{{ $paket->nama }}</td>
                                <td class="border-b border-gray-300 px-8 py-3 text-right">{{ $paket->jumlah_koin }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between mb-2">
                <div>
                    <h2 class="text-lg font-semibold">Paket Harga Koin</h2>
                </div>
                <a onclick="openOverlay('editTunaiOverlay')"
                    class="cursor-pointer inline-flex items-center px-6 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-xl shadow">
                    Edit
                </a>
            </div>
            <div class="bg-white border border-gray-300 mb-6 rounded-xl shadow overflow-hidden">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-12 py-3 text-left ">Nama</th>
                            <th class="px-10 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets->where('id', '>', 6) as $paket)
                            <tr>
                                <td class="border-b border-gray-300 px-8 py-3">{{ $paket->nama }}</td>
                                <td class="border-b border-gray-300 px-8 py-3 text-right">Rp
                                    {{ number_format($paket->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================== OVERLAY EDIT KOIN ================== --}}
    <div id="editKoinOverlay" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
        <form action="{{ route('finance.update') }}" method="POST" class="bg-white rounded-2xl w-[600px] p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-semibold mb-4">Edit Paket Harga Koin</h2>
            <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden mb-4">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="px-6 py-2 text-left">Nama</th>
                        <th class="px-6 py-2 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pakets->where('id', '<=', 6) as $paket)
                        <tr>
                            <td class="border-b border-gray-300 px-6 py-3">{{ $paket->nama }}</td>
                            <td class="border-b border-gray-300 px-6 py-3 text-right">
                                <input type="number" name="jumlah_koin[{{ $paket->id }}]" value="{{ $paket->jumlah_koin }}"
                                    class="border rounded-md px-3 py-1 w-24 text-right focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <span class="text-gray-600 text-sm">Koin</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-medium">
                    Selesai
                </button>
            </div>
        </form>
    </div>

    {{-- ================== OVERLAY EDIT TUNAI ================== --}}
    <div id="editTunaiOverlay"
        class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
        <form action="{{ route('finance.update') }}" method="POST" class="bg-white rounded-2xl w-[600px] p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-semibold mb-4">Edit Paket Harga Tunai</h2>
            <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden mb-4">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="px-6 py-2 text-left">Nama</th>
                        <th class="px-6 py-2 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pakets->where('id', '>', 6) as $paket)
                        <tr>
                            <td class="border-b border-gray-300 px-6 py-3">{{ $paket->nama }}</td>
                            <td class="border-b border-gray-300 px-6 py-3 text-right">
                                <input type="number" name="harga[{{ $paket->id }}]" value="{{ $paket->harga }}"
                                    class="border rounded-md px-3 py-1 w-32 text-right focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-medium">
                    Selesai
                </button>
            </div>
        </form>
    </div>


    {{-- Riwayat --}}
    <div id="riwayat" class="section hidden">
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

    {{-- Laporan --}}
    <div id="laporan" class="section hidden">
        <h2 class="text-lg font-semibold mb-3">Catatan Transaksi Penghasilan</h2>
        <p class="text-sm text-gray-600 mb-3">Hanya catatan transaksi dalam 12 bulan terakhir akan dipertahankan.
            Silahkan download salinan PDF anda.</p>

        {{-- Box Container --}}
        <div class="bg-orange-500 p-6 rounded-2xl">
            <div class="px-8">
                <h2 class="text-lg font-semibold text-white mb-3">Riwayat Koin</h2>

                <div class="flex items-center gap-3 mb-4">
                    <select id="filter"
                        class="px-4 py-2 bg-white text-orange-500 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-300">
                        <option value="">Periode</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>

                    <a href="#" id="btnDetail"
                        class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-200 text-orange-400 text-sm font-medium rounded-md shadow">
                        Detail
                    </a>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="bg-white border border-white rounded-2xl m-12">
                <div class="px-5">
                    <div class="overflow-x-auto">
                        <table class="w-full text-center">
                            <thead class=" text-orange-500">
                                <tr>
                                    <th class="px-4 py-2">No. Referensi</th>
                                    <th class="px-4 py-2">Pendapatan</th>
                                    <th class="px-4 py-2">Koin</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="laporanTable">
                                @foreach ($transaksis as $transaksi)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-center border-t">{{ $transaksi->no_referensi }}</td>
                                        <td class="px-4 py-2 text-center border-t">
                                            Rp{{ number_format($transaksi->tunai, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2 text-center border-t">{{ $transaksi->koin }}</td>
                                        <td class="px-4 py-2 text-center border-t">{{ $transaksi->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Overlay -->
<div id="detailModal"
    class="fixed inset-0 bg-white/30 backdrop-blur-md flex items-center justify-center hidden z-50 transition-opacity duration-300">

    <div class="bg-white/70 backdrop-blur-xl w-3/4 rounded-2xl shadow-2xl p-6 relative border border-white/40">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 transition">
            ✕
        </button>

        <h2 class="text-lg font-semibold mb-4">Laporan Transaksi Penghasilan</h2>

        <a id="downloadPdf" href="#" target="_blank"
            class="inline-flex mb-2 items-center px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm rounded-md shadow">
            <i class="fa fa-download mr-1"></i> Download PDF
        </a>

        <div id="modalContent">
            <p class="text-center text-gray-500">Pilih bulan lalu klik Detail...</p>
        </div>
    </div>
</div>
{{-- Script untuk Filter --}}
<script>
    document.getElementById('sectionFilter').addEventListener('change', function () {
        let sections = document.querySelectorAll('.section');
        sections.forEach(s => s.classList.add('hidden'));
        document.getElementById(this.value).classList.remove('hidden');
    });
    function openOverlay(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeOverlay(id) {
        document.getElementById(id).classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const detailBtn = document.getElementById('btnDetail');
        const filter = document.getElementById('filter');
        const modal = document.getElementById('detailModal');
        const closeModal = document.getElementById('closeModal');
        const modalContent = document.getElementById('modalContent');
        const downloadBtn = document.getElementById('downloadPdf');

        detailBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const bulan = filter.value;
            if (!bulan) {
                alert('Pilih bulan terlebih dahulu!');
                return;
            }

            downloadBtn.href = `/super-admin/finance/transaksi/export-pdff/${bulan}`;
            downloadBtn.classList.remove('hidden');
            modal.classList.remove('hidden');
            modalContent.innerHTML = '<p class="text-center text-gray-500">Memuat data...</p>';

            try {
                const response = await fetch(`/super-admin/finance/transaksii/${bulan}`);
                const data = await response.json();

                if (data.length === 0) {
                    modalContent.innerHTML = '<p class="text-center text-gray-500">Tidak ada data untuk bulan ini.</p>';
                    return;
                }

                let rows = '';
                let totalTunai = 0;
                let totalKoin = 0;

                data.forEach(item => {
                    rows += `
                                                                                        <tr class="hover:bg-gray-50">
                                                                                            <td class="px-4 py-2 text-center">${item.no_referensi}</td>
                                                                                            <td class="px-4 py-2 text-center">${item.dari}</td>
                                                                                            <td class="px-4 py-2 text-center">${item.jenis_transaksi}</td>
                                                                                            <td class="px-4 py-2 text-center">${item.sumber_dana}</td>
                                                                                            <td class="px-4 py-2 text-center">Rp${Number(item.tunai).toLocaleString('id-ID')}</td>
                                                                                            <td class="px-4 py-2 text-center">${item.koin}</td>
                                                                                        </tr>
                                                                                    `;
                    totalTunai += Number(item.tunai);
                    totalKoin += Number(item.koin);
                });

                modalContent.innerHTML = `
                                                                                    <table class="w-full border-collapse border border-gray-200 mb-4">
                                                                                        <thead class="bg-orange-500 text-white">
                                                                                            <tr>
                                                                                                <th class="px-4 py-2 text-center">Transaksi</th>
                                                                                                <th class="px-4 py-2 text-center">Perusahaan</th>
                                                                                                <th class="px-4 py-2 text-center">Jenis Transaksi</th>
                                                                                                <th class="px-4 py-2 text-center">Sumber Dana</th>
                                                                                                <th class="px-4 py-2 text-center">Nominal IDR</th>
                                                                                                <th class="px-4 py-2 text-center">Transaksi Koin</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>${rows}</tbody>
                                                                                    </table>
                                                                                    <div class="text-right font-semibold text-sm">
                                                                                        <p>Total Nominal : Rp${totalTunai.toLocaleString('id-ID')}</p>
                                                                                        <p>Total Koin : ${totalKoin} Koin</p>
                                                                                    </div>
                                                                                `;
            } catch (error) {
                modalContent.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>';
            }
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });
    });
</script>
@endsection