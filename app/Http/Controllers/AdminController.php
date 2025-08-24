<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function index() {
        $userId = Cookie::get('user_id');

        $user = User::where("id", $userId)->first();

        return view("pages.dashboard", compact("user"));
    }
}
