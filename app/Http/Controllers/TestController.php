<?php

namespace App\Http\Controllers;

use App\Notifications\UsersAll;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{

    public $photos = [
        ['file_name' => 'wallpaper', 'validated' => true, 'extension' => 'jpg'],
        ['file_name' => 'spring', 'validated' => true, 'extension' => 'png'],
        ['file_name' => 'flowers', 'validated' => false, 'extension' => 'jpg'],
        ['file_name' => 'mac', 'validated' => true, 'extension' => 'png'],
        ['file_name' => 'books', 'validated' => false, 'extension' => 'jpg'],
        ['file_name' => 'mobiles', 'validated' => false, 'extension' => 'jpg'],
        ['file_name' => 'glass', 'validated' => false, 'extension' => 'png'],
        ['file_name' => 'fruit', 'validated' => true, 'extension' => 'jpg'],
    ];

    public function colectionPluck()
    {
        
    }
    public function testRoutePost(Request $request)
    {
        //throw new \Exception('Test it first');
        $attributes = $request->validate([
            'name' => 'required'
        ]);

    }


}
