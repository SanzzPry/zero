<?php

namespace App\Services\SuperAdmin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\Storage;
use App\Repositories\SuperAdmin\SuperAdminRepository;

class SuperAdminServiceImplement extends ServiceApi implements SuperAdminService
{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    protected string $title = "";
    /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected SuperAdminRepository $mainRepository;

    public function __construct(SuperAdminRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function getAllProfile()
    {
        return $this->mainRepository->all();
    }

    public function getProfileById($id)
    {
        return $this->mainRepository->find($id);
    }

    public function createProfile($data)
    {
        return $this->mainRepository->create($data);
    }


    public function updateProfile($data, $request)
    {
        $user = Auth::user();

        // Upload foto
        if ($request->hasFile('img_profile')) {
            if ($user->img_profile) {
                Storage::disk('public')->delete($user->img_profile);
            }
            $path = $request->file('img_profile')->store('profile', 'public');
            $data['img_profile'] = $path;
        }

        // Hapus foto
        if ($request->filled('remove_photo') && $request->remove_photo == 1) {
            if ($user->img_profile) {
                Storage::disk('public')->delete($user->img_profile);
            }
            $data['img_profile'] = null;
        }

        // Lokasi
        if ($request->provinsi_id) {
            $data['province_id'] = $request->provinsi_id;
            $data['provinsi'] = $request->provinsi;
        }
        if ($request->kabupaten_id) {
            $data['city_id'] = $request->kabupaten_id;
            $data['kota'] = $request->kabupaten;
        }
        if ($request->kecamatan_id) {
            $data['district_id'] = $request->kecamatan_id;
            $data['kecamatan'] = $request->kecamatan;
        }

        // ✅ Update user table (username & email)
        $user->update([
            'username' => $request->username ?? $user->username,
            'email'    => $request->email ?? $user->email,
        ]);

        // ✅ Update super admin profile via repository
        return $this->mainRepository->upsertByUserId($user->id, $data);
    }


    public function deleteProfile($id)
    {
        return $this->mainRepository->delete($id);
    }

    // ambil profile user yang sedang login
    public function getMyProfile()
    {
        $userId = Auth::id();
        return $this->mainRepository->getByUserId($userId);
    }

    // update profile user yang sedang login
    public function updateMyProfile(int $userId, array $data)
    {
        return $this->mainRepository->upsertByUserId($userId, $data);
    }

    public function updateProfileViaAccount($userId, $request, $data)
    {
        // update tabel users
        $user = User::findOrFail($userId);
        $user->update([
            'username' => $request->username ?? $user->username,
            'email'    => $request->email ?? $user->email,
        ]);

        // ambil super_admin berdasarkan user_id
        $superAdmin = $this->mainRepository->getByUserId($userId);

        // Upload foto
        if ($request->hasFile('img_profile')) {
            if ($superAdmin && $superAdmin->img_profile) {
                Storage::disk('public')->delete($superAdmin->img_profile);
            }
            $path = $request->file('img_profile')->store('profile', 'public');
            $data['img_profile'] = $path;
        }

        // Hapus foto
        if ($request->filled('remove_photo') && $request->remove_photo == 1) {
            if ($superAdmin && $superAdmin->img_profile) {
                Storage::disk('public')->delete($superAdmin->img_profile);
            }
            $data['img_profile'] = null;
        }

        // Lokasi
        if ($request->provinsi_id) {
            $data['province_id'] = $request->provinsi_id;
            $data['provinsi'] = $request->provinsi;
        }
        if ($request->kabupaten_id) {
            $data['city_id'] = $request->kabupaten_id;
            $data['kota'] = $request->kabupaten;
        }
        if ($request->kecamatan_id) {
            $data['district_id'] = $request->kecamatan_id;
            $data['kecamatan'] = $request->kecamatan;
        }

        // jangan bawa username & email ke super_admins
        unset($data['username'], $data['email']);

        // update super_admin lewat repository
        return $this->mainRepository->updateByUserId($userId, $data);
    }



    // Define your custom methods :)


}
