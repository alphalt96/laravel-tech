<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "image";

    protected $primaryKey = "id_image";

    public function tableTarget() {
        return $this->morphTo('target');
    }
}
