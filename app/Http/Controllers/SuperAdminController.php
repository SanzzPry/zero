<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperAdminRequest;
use App\Models\SuperAdmin;
use App\Services\SuperAdmin\SuperAdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $superAdminService;

    public function __construct(SuperAdminService $superAdminService)
    {
        $this->superAdminService = $superAdminService;
    }
    public function profileView()
    {
        $profile = Auth::user();

        $user = $this->superAdminService->getMyProfile();
        return view('pages.super-admin.partials.form-profile', compact('user', 'profile'));
    }

    /**
     * Form edit profile
     */
    public function profileEdit()
    {
        $profile = Auth::user();
        $user = $this->superAdminService->getMyProfile();

        return view('pages.super-admin.partials.profile-edit', compact('user', 'profile'));
    }


    /**
     * Update profile user yang sedang login
     */
    public function profileUpdate(SuperAdminRequest $request)
    {
        $data = $request->validated();

        // lempar ke service (semua logic update ada di service)
        $this->superAdminService->updateProfile($data, $request);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function profileUpdateViaAccount($userId, SuperAdminRequest $request)
    {
        $data = $request->validated();

        // lempar ke service (semua logic update ada di service)
        $this->superAdminService->updateProfileViaAccount($userId, $request, $data);

        return redirect()->route('akun.index')->with('success', 'Profile updated successfully!');
    }
}
