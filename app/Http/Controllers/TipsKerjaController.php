<?php

namespace App\Http\Controllers;

use App\Models\TipsKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipsKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipsKerja::query();

        // Filter status (draft/published)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search (title atau tanggal)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereDate('created_at', $search); // kalau mau exact date search
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc'); // default terbaru
        }

        // Ambil data
        $tips = $query->get();

        $countAll = TipsKerja::count();
        $countPublished = TipsKerja::where('status', 'terbit')->count();
        $countDraft = TipsKerja::where('status', 'belum terbit')->count();

        $activeStatus = $request->status ?? 'all';

        return view('pages.super-admin.tips.index', compact(
            'tips',
            'countAll',
            'countPublished',
            'countDraft',
            'activeStatus'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.super-admin.tips.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/tips_images', $imageName); // simpan di storage/app/public/tips_images
        }

        $tip = new TipsKerja();
        $tip->title = $request->title;
        $tip->content = $request->input('content');
        $tip->image = $imageName; // simpan nama file ke DB

        // Tambahkan user yang sedang login
        $tip->penulis = Auth::user()->username; // pastikan kolom user_id ada di table tips_kerja

        $tip->save();

        return redirect()->route('tips.index')->with('success', 'Tips berhasil ditambahkan!');
    }

    public function deleteMultiple(Request $request)
    {
        $request->validate([
            'selected_tips' => 'required|array',
        ]);

        TipsKerja::whereIn('id', $request->selected_tips)->delete();

        return redirect()->route('tips.index')->with('success', 'Tips berhasil dihapus!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tip = TipsKerja::findOrFail($id); // ambil data tips berdasarkan id

        return view('pages.super-admin.tips.show', compact('tip'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipsKerja $tipsKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipsKerja $tipsKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipsKerja $tipsKerja)
    {
        //
    }
}
