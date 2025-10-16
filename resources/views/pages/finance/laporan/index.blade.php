@extends('layouts.finance')

@section('title', 'Laporan Transaksi')

@section('content')
    <div class="px-6 py-6">
        <h2 class="text-lg font-semibold mb-3">Catatan Transaksi Penghasilan</h2>
        <p class="text-sm text-gray-600 mb-3">Hanya catatan transaksi dalam 12 bulan terakhir akan dipertahankan.
            Silahkan download salinan PDF anda.</p>

        <div class="flex items-center justify-end gap-3 mb-4">
            <a href="#" id="btnDetail"
                class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                Detail
            </a>
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
        </div>

        <div class="bg-white border border-gray-300 rounded-xl shadow overflow-hidden">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-orange-500 text-white text-left">
                        <th class="px-4 py-2 text-center">Tanggal</th>
                        <th class="px-4 py-2 text-center">Jenis Transaksi</th>
                        <th class="px-4 py-2 text-center">Penghasilan</th>
                        <th class="px-4 py-2 text-center">Koin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center border-t">{{ $transaksi->created_at }}</td>
                            <td class="px-4 py-2 text-center border-t">{{ $transaksi->pesanan }}</td>
                            <td class="px-4 py-2 text-center border-t">
                                Rp{{ number_format($transaksi->tunai, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 text-center border-t">{{ $transaksi->koin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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


    <script>
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

                downloadBtn.href = `/finance/transaksi/export-pdf/${bulan}`;
                downloadBtn.classList.remove('hidden');
                modal.classList.remove('hidden');
                modalContent.innerHTML = '<p class="text-center text-gray-500">Memuat data...</p>';

                try {
                    const response = await fetch(`/finance/transaksi/${bulan}`);
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