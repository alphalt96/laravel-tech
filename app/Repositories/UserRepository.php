<?php
/**
 * Created by PhpStorm.
 * User: mba0216
 * Date: 2018-12-06
 * Time: 15:48
 */

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getUserDetail($id);
    public function updateUserDetail();
}

class UserRepository implements UserRepositoryInterface {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function updateUserDetail($data = [])
    {
        if (empty($data)) return false;
        return $this->model->update($data);
    }

    public function getUserDetail($id)
    {
        return $this->model->find($id);
    }
}