<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function checkUser(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->withErrors([
                'auth'=> 'Email or Password is not existed',
            ])->withInput();
        }

        Cookie::queue('user_id', $user->id, 60 * 24);

        return redirect("/");
    }
}
