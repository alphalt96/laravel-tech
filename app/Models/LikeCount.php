<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeCount extends Model
{
    protected $table = 'like_count';

    public function Song() {
        $this->belongsTo('App\Models\Song');
    }
}
