<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCount extends Model
{
    protected $table = 'download_count';

    public function Song() {
        return $this->belongsTo('App\Models\Song');
    }
}
