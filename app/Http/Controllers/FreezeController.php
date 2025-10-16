<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Freeze;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use App\Services\User\UserService;

class FreezeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Pelamar::query();

        // Search berdasarroutean nama atau username
        if ($request->filled('search')) {
            $query->where('nama_pelamar', 'like', '%' . $request->search . '%')
                ->orWhere('kategori', 'like', '%' . $request->search . '%');
        }

        // Bisa tambahin filter status kandidat juga kalau mau
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pelamars = $query->get();

        return view('pages.super-admin.freeze.index', compact('pelamars'));
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
    public function show($id)
    {
        $user = Pelamar::with(['skills', 'riwayatPendidikans'])->findOrFail($id);

        return view('pages.super-admin.freeze.banned', compact('user'));
    }

    public function toggle($id, Request $request)
    {
        $user = Pelamar::findOrFail($id);

        if ($user->status == 'banned') {
            // Unbanned
            $user->status = 'unbanned';
            $user->alasan_freeze = null; // reset alasan
            $message = "Akun berhasil di-unbanned.";
        } else {
            // Banned
            $user->status = 'banned';
            $user->alasan_freeze = $request->alasan_freeze;
            $message = "Akun berhasil di-banned.";
        }

        $user->save();

        return redirect()->route('freeze.show', $user->id)->with('success', $message);
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freeze $freeze)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Freeze $freeze)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freeze $freeze)
    {
        //
    }
}
