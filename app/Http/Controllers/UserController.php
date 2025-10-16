<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\SuperAdmin\SuperAdminService;


class UserController extends Controller
{
    protected $superAdminService;
    protected $userService;

    public function __construct(UserService $userService, SuperAdminService $superAdminService)
    {
        $this->superAdminService = $superAdminService;
        $this->userService = $userService;
    }
    public function index()
    {
        $user = $this->userService->getAllUser();

        return view('pages.super-admin.akun.index', [
            'users' => $user,
        ]);
    }

    // public function profileView()
    // {
    //     $user = Auth::user();
    //     return view('pages.super-admin.partials.form-profile', compact('user'));
    // }

    // public function profileUpdate(UserRequest $request)
    // {
    //     $user = Auth::user(); // ambil user yang login
    //     $data = $request->validated();

    //     // Upload foto baru kalau ada
    //     if ($request->hasFile('photo')) {
    //         if ($user->photo) {
    //             Storage::disk('public')->delete($user->photo);
    //         }
    //         $path = $request->file('photo')->store('profile', 'public');
    //         $data['photo'] = $path;
    //     }

    //     // Hapus foto kalau ada flag remove_photo
    //     if ($request->filled('remove_photo') && $request->remove_photo == 1) {
    //         if ($user->photo) {
    //             Storage::disk('public')->delete($user->photo);
    //         }
    //         $data['photo'] = null;
    //     }

    //     // Tambah lokasi kalau ada
    //     if ($request->provinsi_id) {
    //         $data['provinsi_id'] = $request->provinsi_id;
    //         $data['provinsi_name'] = $request->provinsi_name;
    //     }
    //     if ($request->kabupaten_id) {
    //         $data['kabupaten_id'] = $request->kabupaten_id;
    //         $data['kabupaten_name'] = $request->kabupaten_name;
    //     }
    //     if ($request->kecamatan_id) {
    //         $data['kecamatan_id'] = $request->kecamatan_id;
    //         $data['kecamatan_name'] = $request->kecamatan_name;
    //     }

    //     // Update via service
    //     $this->userService->updateUser($user->id, $data);

    //     return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    // }


    // public function profileEdit()
    // {
    //     $user = Auth::user();
    //     return view('pages.super-admin.partials.profile-edit', compact('user'));
    // }
    public function show($id)
    {

        $user = $this->userService->getUserById($id);


        return view('pages.super-admin.akun.show', [
            'user' => $user,

        ]);
    }
    public function create()
    {
        return view('pages.super-admin.akun.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->createUser($data);

        $this->superAdminService->updateMyProfile($user->id, $data);

        return redirect()->route('akun.index')
            ->with('success', 'User data created successfully! Setup Profile?')
            ->with('user_id', $user->id);
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('pages.super-admin.akun.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->getUserById($id);
        $data = $request->validated();

        // Upload foto baru
        if ($request->hasFile('photo')) {
            // hapus foto lama kalau ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // simpan foto baru
            $path = $request->file('photo')->store('profile', 'public');
            $data['photo'] = $path;
        }

        // Jika ada flag remove_photo
        if ($request->has('remove_photo') && $request->remove_photo == 1) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = null;
        }

        // Kalau tidak upload & tidak hapus foto → jaga agar tidak override jadi null
        if (!$request->hasFile('photo') && !($request->has('remove_photo') && $request->remove_photo == 1)) {
            unset($data['photo']);
        }

        $this->userService->updateUser($id, $data);

        return redirect()->route('akun.index')->with('success', 'User updated successfully!');
    }



    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('akun.index')->with('success', 'delete user data succesfully');
    }

    public function pengaturanView()
    {
        return view('pages.super-admin.partials.pengaturan');
    }

    public function pengaturanUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        // cek password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'password lama salah!');
        }

        // update password baru
        $user->password = Hash::make($request->new_password);
        $user->update();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
