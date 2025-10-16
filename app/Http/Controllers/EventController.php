<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();



        // Search (title atau tanggal)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereDate('tgl_mulai', $search); // kalau mau exact date search
            });
        }

        // Ambil data
        $events = $query->get();
        return view('pages.super-admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.super-admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pendaftaran' => 'nullable|string',
            'kuota' => 'nullable|string',
            'tgl_mulai' => 'nullable|string',
            'jam_mulai' => 'nullable|string',
            'tgl_akhir' => 'nullable|string',
            'jam_akhir' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'link_form' => 'nullable|string',
            'penutupan_pendaftaran' => 'nullable|string',
        ]);

        // handle image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $event = Event::create($validated);

        if ($request->has('kegiatan')) {
            foreach ($request->kegiatan as $row) {
                if (!empty($row['jam']) || !empty($row['isi'])) {
                    \App\Models\KegiatanEvent::create([
                        'event_id' => $event->id,
                        'waktu'    => $row['jam'],
                        'kegiatan' => $row['isi'],
                    ]);
                }
            }
        }

        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('pages.super-admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::with('KegiatanEvent')->findOrFail($id);
        return view('pages.super-admin.event.edit', compact('event'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pendaftaran' => 'nullable|string',
            'kuota' => 'nullable|string',
            'tgl_mulai' => 'nullable|string',
            'jam_mulai' => 'nullable|string',
            'tgl_akhir' => 'nullable|string',
            'jam_akhir' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'link_form' => 'nullable|string',
            'penutupan_pendaftaran' => 'nullable|string',
            'kegiatan.*.id' => 'nullable|integer|exists:kegiatan_events,id',
            'kegiatan.*.jam' => 'nullable|string',
            'kegiatan.*.isi' => 'nullable|string',
        ]);

        // Handle image
        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        // Update event utama
        $event->update($validated);

        // Update kegiatan
        if ($request->has('kegiatan')) {
            foreach ($request->kegiatan as $row) {
                if (!empty($row['jam']) || !empty($row['isi'])) {
                    if (!empty($row['id'])) {
                        // update kegiatan lama
                        $kegiatan = \App\Models\KegiatanEvent::find($row['id']);
                        if ($kegiatan) {
                            $kegiatan->update([
                                'waktu' => $row['jam'],
                                'kegiatan' => $row['isi'],
                            ]);
                        }
                    } else {
                        // buat kegiatan baru
                        $event->kegiatanEvent()->create([
                            'waktu' => $row['jam'],
                            'kegiatan' => $row['isi'],
                        ]);
                    }
                } else {
                    // opsional: hapus kegiatan lama kalau jam & isi dikosongkan
                    if (!empty($row['id'])) {
                        \App\Models\KegiatanEvent::find($row['id'])?->delete();
                    }
                }
            }
        }


        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->route('event.index')->with('success', 'delete event data succesfully');
    }

    public function toggleStatus(Event $event)
    {
        $event->status = $event->status === 'buka' ? 'tutup' : 'buka';
        $event->save();

        return response()->json([
            'status' => $event->status
        ]);
    }

    public function partisipan($id)
    {
        $event = Event::findOrFail($id);
        return view('pages.super-admin.event.partisipan', compact('event'));
    }
}
