<?php

namespace App\Repositories\SuperAdmin;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\SuperAdmin;

class SuperAdminRepositoryImplement extends Eloquent implements SuperAdminRepository
{
    /**
     * @var SuperAdmin
     */
    protected $model;

    public function __construct(SuperAdmin $model)
    {
        $this->model = $model;
    }

    /**
     * Ambil semua profile super admin beserta relasi user
     */
    public function all()
    {
        return $this->model->with('user')->get();
    }

    /**
     * Cari profile berdasarkan id
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Buat profile baru
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update profile berdasarkan id
     */
    public function update($id, $data)
    {
        $profile = $this->model->findOrFail($id);
        $profile->update($data);

        return $profile;
    }

    /**
     * Hapus profile berdasarkan id
     */
    public function delete($id)
    {
        $profile = $this->model->findOrFail($id);
        return $profile->delete();
    }

    /**
     * Ambil profile berdasarkan user_id
     */
    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * Update profile berdasarkan user_id
     */

    public function updateByUserId($userId, array $data)
    {
        return $this->model
            ->where('user_id', $userId)
            ->update($data);
    }
    public function upsertByUserId($userId, array $data)
    {
        return $this->model->updateOrCreate(
            ['user_id' => $userId],
            $data
        );
    }
}
