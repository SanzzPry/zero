<?php

namespace App\Services\User;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends ServiceApi implements UserService
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
    protected UserRepository $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getAllUser()
    {
        return $this->mainRepository->all();
    }

    public function getUserById($id)
    {
        return $this->mainRepository->find($id);
    }

    public function createUser($data)
    {
        return $this->mainRepository->create($data);
    }
    public function updateUserProfile($data)
    {
        return $this->mainRepository->updateProfile($data);
    }

    public function updateUser($id, $data)
    {
        return $this->mainRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->mainRepository->delete($id);
    }

    // Define your custom methods :)
}
