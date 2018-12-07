<?php
/**
 * Created by PhpStorm.
 * User: mba0216
 * Date: 2018-12-07
 * Time: 09:51
 */

namespace App\Repositories\User;


interface UserRepositoryInterface
{
    public function createUser($data);
    public function getUserDetail($id, $column);
    public function updateUserDetail();
}