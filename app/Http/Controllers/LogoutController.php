<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function logout() {
        Cookie::queue(Cookie::forget('user_id'));
        return redirect()->route('login');
    }
}
