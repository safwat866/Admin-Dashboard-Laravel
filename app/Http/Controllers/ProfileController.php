<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $imageName =  $request->file("image")->getClientOriginalName();
        $path = $request->file("image")->storeAs("users", $imageName, 'public_user');

        Auth::user()->update([
            'username' => $request->username,
            "email" => $request->email,
            "is_admin" => $request->role,
            "cash" => (float) $request->balance,
            'image' => $path,
        ]);

        return redirect()->route("profile");
    }
}
