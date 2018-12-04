<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    protected $table = 'play_list';

    public function user() {
        $this->belongsTo('App\Models\User');
    }

    public function song() {
        $this->belongsTo('App\Models\Song');
    }
}
