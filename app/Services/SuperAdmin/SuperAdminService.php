<?php

namespace App\Services\SuperAdmin;

use LaravelEasyRepository\BaseService;

interface SuperAdminService extends BaseService
{
    public function getAllProfile();
    public function getProfileById($id);
    public function createProfile($data);
    public function updateProfile($id, $data);
    public function deleteProfile($id);
    public function getMyProfile();
    public function updateMyProfile(int $userId, array $data);
    public function updateProfileViaAccount($id, $data, $request);

    // Write something awesome :)
}
