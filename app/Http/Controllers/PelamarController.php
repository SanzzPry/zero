<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelamar::with(['skills', 'riwayatPendidikans']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_pelamar', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhereHas('skills', function ($q2) use ($search) {
                        $q2->where('skill', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter berdasarkan dropdown (status kandidat)
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default terbaru
        }

        $users = $query->get();

        return view('pages.super-admin.pelamar.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.super-admin.pelamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // ================== SIMPAN USER ==================
            $user = User::create([
                'email'    => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role'     => 'pelamar',
            ]);

            // ================== UPLOAD FOTO ==================
            $imgPath = null;
            if ($request->hasFile('img_profile')) {
                $imgPath = $request->file('img_profile')->store('pelamar/profile', 'public');
            }

            // ================== SIMPAN DATA PELAMAR ==================
            $pelamar = Pelamar::create([
                'user_id'        => $user->id,
                'nama_pelamar'   => $request->full_name ?? null,
                'deskripsi_diri' => $request->deskripsi_diri ?? null,
                'alamat' => $request->alamat ?? null,
                'tanggal_lahir'  => $request->tanggal_lahir ?? null,
                'gender'         => $request->gender ?? null,
                'teleponPelamar' => $request->phone ?? null,
                'divisi'         => $request->divisi ?? null,
                'mulai_pelatihan'  => $request->mulai_pelatihan ?? null,
                'selesai_pelatihan' => $request->selesai_pelatihan ?? null,
                'gaji_minimal'   => $request->gaji_minimal ?? null,
                'gaji_maksimal'  => $request->gaji_maksimal ?? null,
                'img_profile'    => $imgPath,
            ]);

            // ================== SIMPAN PENDIDIKAN ==================
            if ($request->educations) {
                foreach ($request->educations as $edu) {
                    $pelamar->riwayatPendidikans()->create([
                        'pendidikan'     => $edu['pendidikan'] ?? null,
                        'jurusan'        => $edu['jurusan'] ?? null,
                        'asal_pendidikan' => $edu['asal_pendidikan'] ?? null,
                        'tahun_awal'     => $edu['tahun_awal'] ?? null,
                        'tahun_akhir'    => $edu['tahun_akhir'] ?? null,
                    ]);
                }
            }

            // ================== SIMPAN PENGALAMAN KERJA ==================
            if ($request->experiences) {
                foreach ($request->experiences as $exp) {
                    $pelamar->pengalamanKerjas()->create([
                        'posisi_pekerjaan'  => $exp['posisi_pekerjaan'] ?? null,
                        'jabatan_pekerjaan' => $exp['jabatan_pekerjaan'] ?? null,
                        'nama_perusahaan'   => $exp['nama_perusahaan'] ?? null,
                        'tahun_awal'        => $exp['tahun_awal'] ?? null,
                        'tahun_akhir'       => $exp['tahun_akhir'] ?? null,
                        'deskripsi'         => $exp['deskripsi'] ?? null,
                    ]);
                }
            }

            // ================== SIMPAN ORGANISASI ==================
            if ($request->organizations) {
                foreach ($request->organizations as $org) {
                    $pelamar->pengalamanOrganisasis()->create([
                        'nama_organisasi' => $org['nama_organisasi'] ?? null,
                        'jabatan'         => $org['jabatan'] ?? null,
                        'tahun_awal'      => $org['tahun_awal'] ?? null,
                        'tahun_akhir'     => $org['tahun_akhir'] ?? null,
                        'deskripsi'       => $org['deskripsi'] ?? null,
                    ]);
                }
            }

            // ================== SIMPAN SKILL ==================
            if ($request->skills) {
                foreach ($request->skills as $skill) {
                    $pelamar->skills()->create([
                        'skill'           => $skill['skill'] ?? null,
                        'experience_level' => $skill['experience_level'] ?? null,
                    ]);
                }
            }

            // ================== SIMPAN SOSMED ==================
            if ($request->socials) {
                $pelamar->socialMediaPelamar()->create([
                    'instagram' => $request->socials['instagram'] ?? null,
                    'linkedin'  => $request->socials['linkedin'] ?? null,
                    'website'   => $request->socials['website'] ?? null,
                    'twitter'   => $request->socials['twitter'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getTraceAsString());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelamar = Pelamar::with(['user', 'skills', 'riwayatPendidikans', 'pengalamanKerjas', 'pengalamanOrganisasis', 'socialMediaPelamar'])->findOrFail($id);

        return view('pages.super-admin.pelamar.show', compact('pelamar'));
    }

    public function indexCV()
    {
        return view('pages.super-admin.pelamar.cv');
    }

    public function download($id)
    {
        $pelamar = Pelamar::with(['skills', 'riwayatPendidikans', 'pengalamanKerjas', 'pengalamanOrganisasis', 'socialMediaPelamar', 'user'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('pages.super-admin.pelamar.download', compact('pelamar'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('CV-' . $pelamar->nama_pelamar . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelamar = Pelamar::with([
            'user',
            'skills',
            'riwayatPendidikans',
            'pengalamanKerjas',
            'pengalamanOrganisasis',
            'socialMediaPelamar'
        ])->findOrFail($id);

        return view('pages.super-admin.pelamar.edit', compact('pelamar'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $pelamar = Pelamar::with(['user', 'skills', 'riwayatPendidikans', 'pengalamanKerjas', 'pengalamanOrganisasis', 'socialMediaPelamar'])
                ->findOrFail($id);

            // ================== UPDATE USER ==================
            $pelamar->user->update([
                'email'    => $request->email,
                'username' => $request->username,
                // Update password hanya kalau diisi
                'password' => $request->filled('password')
                    ? bcrypt($request->password)
                    : $pelamar->user->password,
            ]);

            // ================== UPDATE FOTO ==================
            $imgPath = $pelamar->img_profile;
            if ($request->hasFile('img_profile')) {
                $imgPath = $request->file('img_profile')->store('pelamar/profile', 'public');
            }

            // ================== UPDATE DATA PELAMAR ==================
            $pelamar->update([
                'nama_pelamar'   => $request->full_name ?? null,
                'deskripsi_diri' => $request->deskripsi_diri ?? null,
                'alamat'         => $request->alamat ?? null,
                'tanggal_lahir'  => $request->tanggal_lahir ?? null,
                'gender'         => $request->gender ?? null,
                'teleponPelamar' => $request->phone ?? null,
                'divisi'         => $request->divisi ?? null,
                'mulai_pelatihan'  => $request->mulai_pelatihan ?? null,
                'selesai_pelatihan' => $request->selesai_pelatihan ?? null,
                'gaji_minimal'   => $request->gaji_minimal ?? null,
                'gaji_maksimal'  => $request->gaji_maksimal ?? null,
                'img_profile'    => $imgPath,
            ]);

            // ================== UPDATE PENDIDIKAN ==================
            $pelamar->riwayatPendidikans()->delete();
            if ($request->educations) {
                foreach ($request->educations as $edu) {
                    $pelamar->riwayatPendidikans()->create([
                        'pendidikan'      => $edu['pendidikan'] ?? null,
                        'jurusan'         => $edu['jurusan'] ?? null,
                        'asal_pendidikan' => $edu['asal_pendidikan'] ?? null,
                        'tahun_awal'      => $edu['tahun_awal'] ?? null,
                        'tahun_akhir'     => $edu['tahun_akhir'] ?? null,
                    ]);
                }
            }

            // ================== UPDATE PENGALAMAN KERJA ==================
            $pelamar->pengalamanKerjas()->delete();
            if ($request->experiences) {
                foreach ($request->experiences as $exp) {
                    $pelamar->pengalamanKerjas()->create([
                        'posisi_pekerjaan'  => $exp['posisi_pekerjaan'] ?? null,
                        'jabatan_pekerjaan' => $exp['jabatan_pekerjaan'] ?? null,
                        'nama_perusahaan'   => $exp['nama_perusahaan'] ?? null,
                        'tahun_awal'        => $exp['tahun_awal'] ?? null,
                        'tahun_akhir'       => $exp['tahun_akhir'] ?? null,
                        'deskripsi'         => $exp['deskripsi'] ?? null,
                    ]);
                }
            }

            // ================== UPDATE ORGANISASI ==================
            $pelamar->pengalamanOrganisasis()->delete();
            if ($request->organizations) {
                foreach ($request->organizations as $org) {
                    $pelamar->pengalamanOrganisasis()->create([
                        'nama_organisasi' => $org['nama_organisasi'] ?? null,
                        'jabatan'         => $org['jabatan'] ?? null,
                        'tahun_awal'      => $org['tahun_awal'] ?? null,
                        'tahun_akhir'     => $org['tahun_akhir'] ?? null,
                        'deskripsi'       => $org['deskripsi'] ?? null,
                    ]);
                }
            }

            // ================== UPDATE SKILL ==================
            $pelamar->skills()->delete();
            if ($request->skills) {
                foreach ($request->skills as $skill) {
                    $pelamar->skills()->create([
                        'skill'            => $skill['skill'] ?? null,
                        'experience_level' => $skill['experience_level'] ?? null,
                    ]);
                }
            }

            // ================== UPDATE SOSIAL MEDIA ==================
            if ($pelamar->socialMediaPelamar) {
                $pelamar->socialMediaPelamar->update([
                    'instagram' => $request->socials['instagram'] ?? null,
                    'linkedin'  => $request->socials['linkedin'] ?? null,
                    'website'   => $request->socials['website'] ?? null,
                    'twitter'   => $request->socials['twitter'] ?? null,
                ]);
            } else {
                $pelamar->socialMediaPelamar()->create([
                    'instagram' => $request->socials['instagram'] ?? null,
                    'linkedin'  => $request->socials['linkedin'] ?? null,
                    'website'   => $request->socials['website'] ?? null,
                    'twitter'   => $request->socials['twitter'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('pelamar.index')->with('success', 'Data pelamar berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function calon($id)
    {
        $user = Pelamar::with('riwayatPendidikans')->findOrFail($id);
        return view('pages.super-admin.pelamar.calon', compact('user'));
    }

    public function calonUpdate(Request $request, $id)
    {
        $pelamar = Pelamar::findOrFail($id);

        // Kalau ada field 'status' berarti tombol Lulus/Gugur yang diklik
        if ($request->has('kategori')) {
            $pelamar->kategori = $request->kategori;
            $pelamar->save();

            return redirect()->route('pelamar.index')->with('success', 'Status kandidat berhasil diperbarui!');
        }

        // Kalau bukan, berarti form pelatihan
        $validated = $request->validate([
            'divisi' => 'nullable|string|max:255',
            'mulai_pelatihan' => 'nullable|date',
            'selesai_pelatihan' => 'nullable|date|after_or_equal:mulai_pelatihan',
        ]);

        $pelamar->update([
            'divisi' => $validated['divisi'] ?? $pelamar->divisi,
            'mulai_pelatihan' => $validated['mulai_pelatihan'] ?? $pelamar->mulai_pelatihan,
            'selesai_pelatihan' => $validated['selesai_pelatihan'] ?? $pelamar->selesai_pelatihan,
        ]);

        return redirect()->route('pelamar.index')->with('success', 'Data pelatihan kandidat berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelamar $pelamar)
    {
        // Hapus user juga
        $pelamar->user()->delete();

        // Hapus pelamar
        $pelamar->delete();

        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil dihapus');
    }
    public function destroyFreeze(Pelamar $pelamar)
    {
        // Hapus user juga
        $pelamar->user()->delete();

        // Hapus pelamar
        $pelamar->delete();

        return redirect()->route('freeze.index')->with('success', 'Pelamar berhasil dihapus');
    }
}
