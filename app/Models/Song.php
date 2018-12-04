<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'song';

    protected $primaryKey = 'id_song';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function songType() {
        return $this->belongsTo('App\Models\SongType');
    }

    public function likeCount() {
        return $this->hasOne('App\Models\LikeCount');
    }

    public function downloadCounts() {
        return $this->hasMany('App\Models\DownloadCount');
    }

    public function image() {
        return $this->morphMany(Image::class, 'target', 'target_type', 'id_target_ref');
    }
}
