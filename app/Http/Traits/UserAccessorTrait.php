<?php
/**
 * Created by PhpStorm.
 * User: mba0216
 * Date: 2018-11-30
 * Time: 15:52
 */

namespace App\Http\Traits;


trait UserAccessorTrait
{
    public function getAvatarLinkAttribute($value) {
        dd('cc');
       return request()->getHost() + config("path.public.avatar") + $value;
    }
}
