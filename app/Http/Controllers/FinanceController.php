<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\CatatanCash;
use App\Models\CatatanKoin;
use Illuminate\Http\Request;
use App\Models\HargaPembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CatatanTransaksi;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = HargaPembayaran::all();
        $transaksis = CatatanTransaksi::all();
        $koins = CatatanKoin::all();
        $cashes = CatatanCash::all();

        return view('pages.super-admin.finance.index', compact('pakets', 'transaksis', 'koins', 'cashes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Update jumlah_koin
        if ($request->has('jumlah_koin')) {
            foreach ($request->jumlah_koin as $id => $jumlah_koin) {
                $paket = HargaPembayaran::find($id);
                if ($paket) {
                    $paket->jumlah_koin = $jumlah_koin;
                    $paket->save();
                }
            }
        }

        // Update harga
        if ($request->has('harga')) {
            foreach ($request->harga as $id => $harga) {
                $paket = HargaPembayaran::find($id);
                if ($paket) {
                    $paket->harga = $harga;
                    $paket->save();
                }
            }
        }

        return redirect()->route('finance.index')->with('success', 'Harga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        //
    }


    public function paketView()
    {
        $pakets = HargaPembayaran::all();
        return view('pages.finance.paket.index', compact('pakets'));
    }

    public function paketUpdate(Request $request)
    {
        // Update jumlah_koin
        if ($request->has('jumlah_koin')) {
            foreach ($request->jumlah_koin as $id => $jumlah_koin) {
                $paket = HargaPembayaran::find($id);
                if ($paket) {
                    $paket->jumlah_koin = $jumlah_koin;
                    $paket->save();
                }
            }
        }

        // Update harga
        if ($request->has('harga')) {
            foreach ($request->harga as $id => $harga) {
                $paket = HargaPembayaran::find($id);
                if ($paket) {
                    $paket->harga = $harga;
                    $paket->save();
                }
            }
        }

        return redirect()->route('paket.index')->with('success', 'Harga berhasil diperbarui.');
    }

    public function catatanView()
    {
        $cashes = CatatanCash::all();

        $koins = CatatanKoin::all();
        return view('pages.finance.catatan.index', compact('cashes', 'koins'));
    }
    public function omsetView(Request $request)
    {
        $bulan = $request->get('bulan');

        // Ambil semua data
        $query = CatatanTransaksi::query();

        // Filter berdasarkan bulan (kalau dipilih)
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        // Ambil hasil
        $transaksis = $query->get();

        // Hitung total dan rata-rata
        $totalOmset = $transaksis->sum('tunai');
        $rataRata = $transaksis->avg('tunai');

        return view('pages.finance.omset.index', compact('transaksis', 'totalOmset', 'rataRata'));
    }

    public function downloadOmset(Request $request)
    {
        // ambil filter dari request (misal bulan/tahun)
        $query = CatatanTransaksi::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $transaksis = $query->get();

        $totalOmset = $transaksis->sum('tunai');
        $rataRata = $transaksis->avg('tunai');

        $pdf = Pdf::loadView('pages.finance.omset.pdf', [
            'transaksis' => $transaksis,
            'totalOmset' => $totalOmset,
            'rataRata' => $rataRata,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-omset.pdf');
    }

    public function laporanView()
    {
        $transaksis = CatatanTransaksi::all();

        $koins = CatatanKoin::all();
        return view('pages.finance.laporan.index', compact('transaksis', 'koins'));
    }
    public function detailView()
    {
        $transaksis = CatatanTransaksi::all();

        $koins = CatatanKoin::all();
        return view('pages.finance.laporan.show', compact('transaksis', 'koins'));
    }

    public function getTransaksiByMonthh($bulan)
    {
        $transaksis = CatatanTransaksi::whereMonth('created_at', $bulan)->get();

        // Kirim JSON ke frontend
        return response()->json($transaksis);
    }
    public function getTransaksiByMonth($bulan)
    {
        $transaksis = CatatanTransaksi::whereMonth('created_at', $bulan)->get();

        // Kirim JSON ke frontend
        return response()->json($transaksis);
    }
    public function exportPDFF($bulan)
    {
        $transaksis = CatatanTransaksi::whereMonth('created_at', $bulan)->get();

        $totalTunai = $transaksis->sum('tunai');
        $totalKoin = $transaksis->sum('koin');

        $namaBulan = date('F', mktime(0, 0, 0, $bulan, 10));

        $pdf = Pdf::loadView('pages.super-admin.finance.laporan-pdf', compact('transaksis', 'totalTunai', 'totalKoin', 'namaBulan'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("Laporan_Transaksi_{$namaBulan}.pdf");
    }
    public function exportPDF($bulan)
    {
        $transaksis = CatatanTransaksi::whereMonth('created_at', $bulan)->get();

        $totalTunai = $transaksis->sum('tunai');
        $totalKoin = $transaksis->sum('koin');

        $namaBulan = date('F', mktime(0, 0, 0, $bulan, 10));

        $pdf = Pdf::loadView('pages.finance.laporan.laporan-pdf', compact('transaksis', 'totalTunai', 'totalKoin', 'namaBulan'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("Laporan_Transaksi_{$namaBulan}.pdf");
    }

    public function bukti($id)
    {
        $cash = CatatanCash::findOrFail($id);

        $koins = CatatanKoin::findOrFail($id);
        return view('pages.finance.catatan.bukti', compact('cash', 'koins'));
    }
    public function buktik($id)
    {
        $cash = CatatanCash::findOrFail($id);

        $koins = CatatanKoin::findOrFail($id);
        return view('pages.finance.catatan.buktik', compact('cash', 'koins'));
    }
}
