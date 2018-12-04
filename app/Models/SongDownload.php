<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongDownload extends Model
{
    protected $table = 'song_download';

    public function user() {
        $this->belongsTo('App\Models\User');
    }

    public function song() {
        $this->belongsTo('App\Models\Song');
    }
}
