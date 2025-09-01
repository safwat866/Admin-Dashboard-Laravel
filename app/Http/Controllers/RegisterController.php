<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm() {
        return view("auth.register");
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|unique:users|min:8|',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
         
        return redirect()->route("home");
    }
}
