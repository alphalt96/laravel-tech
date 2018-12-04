<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function song() {
        return $this->belongsTo('App\Models\Song');
    }
}
