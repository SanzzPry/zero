<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        $users = $this->model->create($data);
        return $users;
    }
    public function updateProfile($data)
    {
        $users = $this->model->create($data);
        return $users;
    }

    public function update($id, $data)
    {
        $users = $this->find($id);
        $users->update($data);
        return $users;
    }

    public function delete($id)
    {
        $users = $this->find($id);
        $result = $users->delete();
        return $result;
    }

    // Write something awesome :)
}
