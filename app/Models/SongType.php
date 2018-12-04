<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongType extends Model
{
    protected $table = 'song_type';

    public function Songs() {
        return $this->hasMany('App\Models\Song');
    }
}
