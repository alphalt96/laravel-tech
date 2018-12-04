<?php

namespace App\Models;

use App\Http\Traits\UserAccessorTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UserAccessorTrait;

    protected $table = 'user';

    protected $primaryKey = 'id_user';

    protected $idUser;

    protected $appends = ['avatar_link'];

    public function __construct($id = null)
    {
        parent::__construct();
        if (!is_null($id)) {
            $this->idUser = $id;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'id_user_role',
    ];

    public function UserRole() {
        return $this->belongsTo('App\Model\UserRole', 'id_user_role', 'id_user_role');
    }

    public function songs() {
        return $this->hasMany('App\Models\Song', 'id_user', 'id_user');
    }

    public function likes() {
        return $this->hasMany('App\Models\like', 'id_like', 'id_like');
    }

    public function playLists() {
        return $this->hasMany('App\Models\PlayList', 'id_play_list', 'id_play_list');
    }

    public function songDownloads() {
        return $this->hasMany('App\Models\SongDownload');
    }

    public function findUser($column) {
        try {
            return self::select($column)->find($this->idUser);
        } catch (\Exception $e) {
            return $e;
        }
    }

//    public function getUsernameAttribute()
//    {
//        dd("cc");
//    }

    public function image() {
        return $this->morphMany(Image::class, 'target', 'target_type', 'id_target_ref');
    }
}