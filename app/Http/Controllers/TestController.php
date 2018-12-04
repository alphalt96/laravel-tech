<?php

namespace  App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Song;
use App\Models\User;

class TestController extends Controller {
    public function test() {
        $user = User::find(1);
        $image = new Image();
        $image->url = "abc";
        $user->image()->save($image);

        $song = Song::find(1);
        $image = new Image();
        $image->url = "abc";
        $song->image()->save($image);
    }
}
