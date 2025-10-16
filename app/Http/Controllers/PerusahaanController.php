<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelamar;
use App\Models\Perusahaan;
use App\Models\TalentHunter;
use Illuminate\Http\Request;
use App\Models\LowonganPerusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnCallback;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Perusahaan::with(['panggilan', 'talent']);

        // filter pencarian perusahaan
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('namaPerusahaan', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhereHas('panggilan', function ($sub) use ($search) {
                        $sub->where('jenis_panggilan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('talent', function ($sub) use ($search) {
                        $sub->where('posisi', 'like', "%{$search}%");
                    });
            });
        }

        $section = $request->get('section', 'perusahaan');

        // sorting
        if ($section === 'perusahaan') {
            $query->orderBy('created_at', $request->sort === 'oldest' ? 'asc' : 'desc');
        }

        // ambil semua perusahaan
        $users = $query->get();

        // ambil semua pelamar TANPA relasi
        $pelamars = Pelamar::orderBy('created_at', $request->sort === 'oldest' ? 'asc' : 'desc')->get();

        return view('pages.super-admin.perusahaan.index', compact('users', 'section', 'pelamars'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.super-admin.perusahaan.create');
    }

    public function createLow($perusahaan_id = null)
    {
        return view('pages.super-admin.perusahaan.lowongan.create', compact('perusahaan_id'));
    }

    public function storeLow(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis' => 'required|string',
            'gaji_awal' => 'required|numeric|min:0',
            'gaji_akhir' => 'required|numeric|gte:gaji_awal',
            'deskripsi' => 'required|string',
            'pendidikan' => 'required|string',
            'jurusan' => 'nullable|string',
            'gender' => 'required|string',
            'umur_min' => 'nullable|integer|min:0',
            'umur_max' => 'nullable|integer|gte:umur_min',
            'batas_lamaran' => 'required|date',
            'perusahaan_id' => 'nullable|exists:perusahaans,id',
        ]);

        // 🔸 Gabungkan syarat pekerjaan jadi 1 array
        $syarat = [
            'pendidikan' => $request->pendidikan,
            'jurusan' => $request->jurusan,
            'gender' => $request->gender,
            'umur_min' => $request->umur_min,
            'umur_max' => $request->umur_max,
        ];

        // 🔸 Simpan ke tabel
        LowonganPerusahaan::create([
            'perusahaan_id' => $request->perusahaan_id,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'gaji_awal' => $request->gaji_awal,
            'gaji_akhir' => $request->gaji_akhir,
            'label_gaji' => $request->periode ?? 'Bulan',
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'batas_lamaran' => $request->batas_lamaran,
            'syarat_pekerjaan' => json_encode($syarat),
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function showLow($id)
    {
        $lowongan = LowonganPerusahaan::findOrFail($id);
        return view('pages.super-admin.perusahaan.lowongan.show', compact('lowongan'));
    }
    public function editLow($id)
    {
        $lowongan = LowonganPerusahaan::findOrFail($id);
        return view('pages.super-admin.perusahaan.lowongan.edit', compact('lowongan'));
    }


    public function updateLow(Request $request, $id)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'alamat'         => 'required|string|max:255',
            'jenis'          => 'required|string',
            'gaji_awal'      => 'required|numeric|min:0',
            'gaji_akhir'     => 'required|numeric|min:0|gte:gaji_awal',
            'label_gaji'     => 'required|string',
            'deskripsi'      => 'required|string',
            'pendidikan'     => 'required|string',
            'gender'         => 'required|string',
            'batas_lamaran'  => 'required|date',
        ]);

        $lowongan = LowonganPerusahaan::findOrFail($id);

        // Gabungkan data syarat pekerjaan ke dalam satu kolom JSON
        $syarat = [
            'pendidikan' => $request->pendidikan,
            'jurusan'    => $request->jurusan,
            'gender'     => $request->gender,
            'umur_min'   => $request->umur_min,
            'umur_max'   => $request->umur_max,
        ];

        $lowongan->update([
            'perusahaan_id'   => $request->perusahaan_id,
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'jenis'           => $request->jenis,
            'gaji_awal'       => $request->gaji_awal,
            'gaji_akhir'      => $request->gaji_akhir,
            'label_gaji'      => $request->label_gaji,
            'deskripsi'       => $request->deskripsi,
            'syarat_pekerjaan' => json_encode($syarat),
            'batas_lamaran'   => $request->batas_lamaran,
        ]);

        return redirect()
            ->route('lowongan.show', $lowongan->id)
            ->with('success', 'Data lowongan berhasil diperbarui!');
    }

    public function destroyLow(LowonganPerusahaan $lowonganPerusahaan)
    {

        // Hapus $lowonganPerusahaan
        $lowonganPerusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'perusahaan berhasil dihapus');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // ================== VALIDASI ==================
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string',

                'namaPerusahaan' => 'required|string|max:255',
                'legalitas' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'visi' => 'required|string',
                'misi' => 'required|string',
                'teleponPerusahaan' => 'required|string|max:20',
                'whatsapp' => 'required|string|max:20',
                'img_profile' => 'nullable|image',
            ]);

            // ================== SIMPAN USER ==================
            $user = User::create([
                'email'    => $validated['email'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
                'role'     => 'perusahaan', // tambahin biar konsisten role-nya
            ]);

            // ================== UPLOAD FOTO ==================
            $imgPath = null;
            if ($request->hasFile('img_profile')) {
                $imgPath = $request->file('img_profile')->store('perusahaan/profile', 'public');
            }

            // ================== SIMPAN DATA PERUSAHAAN ==================
            Perusahaan::create([
                'user_id'            => $user->id,
                'namaPerusahaan'     => $validated['namaPerusahaan'],
                'legalitas'          => $validated['legalitas'],
                'deskripsi'          => $validated['deskripsi'],
                'visi'               => $validated['visi'],
                'misi'               => $validated['misi'],
                'teleponPerusahaan'  => $validated['teleponPerusahaan'],
                'whatsapp'           => $validated['whatsapp'],
                'img_profile'        => $imgPath,
            ]);

            DB::commit();
            return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Jangan pakai dd() di produksi
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $perusahaan = Perusahaan::with(['user', 'lowongan'])->findOrFail($id);
        return view('pages.super-admin.perusahaan.show', compact('perusahaan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('pages.super-admin.perusahaan.edit', compact('perusahaan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $perusahaan = Perusahaan::with('user')->findOrFail($id);

            // Pastikan relasi user ada
            if ($perusahaan->user) {
                $perusahaan->user->update([
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => $request->filled('password')
                        ? bcrypt($request->password)
                        : $perusahaan->user->password,
                ]);
            }

            // Upload foto baru
            $imgPath = $perusahaan->img_profile;
            if ($request->hasFile('img_profile')) {
                if ($imgPath && Storage::disk('public')->exists($imgPath)) {
                    Storage::disk('public')->delete($imgPath);
                }
                $imgPath = $request->file('img_profile')->store('perusahaan/profile', 'public');
            }

            // Update data perusahaan
            $perusahaan->update([
                'namaPerusahaan' => $request->namaPerusahaan,
                'legalitas' => $request->legalitas,
                'deskripsi' => $request->deskripsi,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'teleponPerusahaan' => $request->teleponPerusahaan,
                'whatsapp' => $request->whatsapp,
                'img_profile' => $imgPath,
            ]);

            DB::commit();
            return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getTraceAsString());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->user()->delete();

        // Hapus $perusahaan
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'perusahaan berhasil dihapus');
    }

    public function showTalent($id)
    {
        $talent = TalentHunter::findOrFail($id);
        return view('pages.super-admin.perusahaan.talent.show', compact('talent'));
    }

    public function createTalent($perusahaan_id = null)
    {
        return view('pages.super-admin.perusahaan.talent.create', compact('perusahaan_id'));
    }


    public function storeTalent(Request $request)
    {

        // Validasi input
        $request->validate([
            'perusahaan_id' => 'required|integer|exists:perusahaans,id',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'posisi' => 'required|string|max:255',
            'gender' => 'nullable|in:Laki-Laki,Perempuan',
            'gaji_awal' => 'required|numeric|min:0',
            'gaji_akhir' => 'required|numeric|min:0|gte:gaji_awal',
            'pengalaman_kerja' => 'required|string',
        ], [
            'alamat.required' => 'Alamat wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'posisi.required' => 'Posisi wajib diisi.',
            'gaji_awal.required' => 'Gaji awal wajib diisi.',
            'gaji_akhir.required' => 'Gaji akhir wajib diisi.',
            'pengalaman_kerja.required' => 'Detail tambahan wajib diisi.',
        ]);

        // Simpan data ke database
        TalentHunter::create([
            'perusahaan_id' => $request->perusahaan_id,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'posisi' => $request->posisi,
            'gender' => $request->gender,
            'gaji_awal' => $request->gaji_awal,
            'gaji_akhir' => $request->gaji_akhir,
            'pengalaman_kerja' => $request->pengalaman_kerja,
        ]);

        // Redirect ke halaman detail talent
        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data Talent Hunter berhasil ditambahkan!');
    }

    public function editTalent($id)
    {
        $talent = TalentHunter::findOrFail($id);
        return view('pages.super-admin.perusahaan.talent.edit', compact('talent'));
    }
    public function updateTalent(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'posisi' => 'required|string|max:255',
            'gender' => 'nullable|in:Laki-Laki,Perempuan',
            'gaji_awal' => 'required|numeric|min:0',
            'gaji_akhir' => 'required|numeric|min:0|gte:gaji_awal',
            'pengalaman_kerja' => 'required|string',
        ], [
            'alamat.required' => 'Alamat wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'posisi.required' => 'Posisi wajib diisi.',
            'gaji_awal.required' => 'Gaji awal wajib diisi.',
            'gaji_akhir.required' => 'Gaji akhir wajib diisi.',
            'pengalaman_kerja.required' => 'Detail tambahan wajib diisi.',
        ]);

        // Ambil data talent berdasarkan ID
        $talent = TalentHunter::findOrFail($id);

        // Update data
        $talent->update([
            'perusahaan_id' => $request->perusahaan_id,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'posisi' => $request->posisi,
            'gender' => $request->gender,
            'gaji_awal' => $request->gaji_awal,
            'gaji_akhir' => $request->gaji_akhir,
            'pengalaman_kerja' => $request->pengalaman_kerja,
        ]);

        // Redirect setelah update
        return redirect()
            ->route('talent.show', $talent->id)
            ->with('success', 'Data Talent Hunter berhasil diperbarui!');
    }
}
