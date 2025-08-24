<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function createUser(Request $req)
    {
         $req->validate([
            'username' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|unique:users|min:8|',
        ]);

        $user = User::create([
            'username' => $req->username,
            'email'=> $req->email,
            'password' => Hash::make($req->password),
        ]);

        $userId = User::where('email', $req->email)->first();

        Cookie::queue('user_id', $userId->id, 60 * 24);
         
        return redirect('/');
    }
}
