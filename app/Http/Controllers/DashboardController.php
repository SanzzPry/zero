<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CatatanCash;
use App\Models\CatatanKoin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Psy\CodeCleaner\ReturnTypePass;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pelamar = User::where('role', 'pelamar')->count();
        $superAdmin = User::where('role', 'superAdmin')->count();
        $perusahaan = User::where('role', 'perusahaan')->count();

        // 🔸 Ambil data bulan & tahun ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // 🔸 Hitung total omset & total koin bulan ini
        $totalOmsetBulanIni = CatatanCash::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total');

        $totalKoinBulanIni = CatatanKoin::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total');

        $koins = CatatanKoin::latest()->get();

        // 🔸 Role handling
        if (Auth::user()->role == 'superadmin') {
            return view('pages.super-admin.index', [
                'pelamar' => $pelamar,
                'superAdmin' => $superAdmin,
                'perusahaan' => $perusahaan,
            ]);
        } elseif (Auth::user()->role == "finance") {
            return view('pages.finance.index', [
                'totalOmsetBulanIni' => $totalOmsetBulanIni,
                'totalKoinBulanIni' => $totalKoinBulanIni,
                'koins' => $koins,
            ]);
        }
    }
}
