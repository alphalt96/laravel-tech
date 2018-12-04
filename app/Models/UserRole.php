<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    public function Users() {
        return $this->hasMany('App\Models\User');
    }
}
