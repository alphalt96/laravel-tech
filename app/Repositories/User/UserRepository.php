<?php
/**
 * Created by PhpStorm.
 * User: mba0216
 * Date: 2018-12-06
 * Time: 15:48
 */

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {

    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param $data
     * @return User
     */
    public function createUser($data)
    {
        if (empty($data)) return false;
        $this->model->unguard();
        $dataReturn = $this->model->create($data);
        $this->model->reguard();
        return $dataReturn;
    }

    public function updateUserDetail($data = [])
    {
        if (empty($data)) return false;
        return $this->model->update($data);
    }

    public function getUserDetail($id, $column)
    {
        return $this->model->select($column)->find($id);
    }
}