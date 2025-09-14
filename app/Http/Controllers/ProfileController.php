<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function showProfileForm()
    {
        $roles = DB::table("roles")->get();
        return view("pages.user_profile", compact("roles"));
    }

    public function index(Request $request)
    {
        if ($request->file("image")) {
            $imageName = $request->file("image")->getClientOriginalName();
            $path = $request->file("image")->storeAs("users", $imageName, 'public_user');
        }

        Auth::user()->update([
            'username' => $request->username,
            "email" => $request->email,
            "cash" => (float) $request->balance,
            'image' => $path ?? Auth::user()->image,
        ]);

        Auth::user()->syncRoles([$request->role]);

        return redirect()->route("profile");
    }
}
