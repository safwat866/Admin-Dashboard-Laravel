<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ShowUser extends Controller
{
    public function show() {
        $userId = Cookie::get('user_id');

        $user = User::where("id", $userId)->first();

       return view("home", compact("user"));
    }
}
