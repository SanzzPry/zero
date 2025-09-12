<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{

    public function all();
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function updateProfile($data);
    public function delete($id);
    // Write something awesome :)
}
