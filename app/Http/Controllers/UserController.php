<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function index()
    {
        $userId = Cookie::get('user_id');

        $user = User::where("id", $userId)->first();

        $allUsers = User::all();

        return view('pages.users', [
            'user' => $user,
            "allUsers" => $allUsers
        ]);
    }

    public function edit($id)
    {
        $userId = Cookie::get('user_id');

        $user = User::where("id", $userId)->first();

        $currentUser = User::where("id", $id)->first();

        return view('pages.edit_user', [
            "user" => $user,
            "current_user" => $currentUser,
        ]);
    }

    public function update(Request $request)
    {
        // letUser::find($request->id);

        // User::update([
        //     'username' => $request->name,
        //     'is_admin' => $request->role,
        //     'email' => $request->email,
        //     'cash' => $request->balance,
        // ]);

        User::where("id", $request->id)->update([
            'username' => $request->name,
            'is_admin' => $request->role,
            'email' => $request->email,
            'cash' => $request->balance,
        ]);


        return redirect()->route('dashboard.users');
    }
}
