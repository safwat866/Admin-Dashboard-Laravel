<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("pages.users", compact("users"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!Auth::user()->can("edit users")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        $roles = DB::table("roles")->get();
        return view("pages.edit_user", compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->file("image")) {
            $imageName = $request->file("image")->getClientOriginalName() || "";
            $path = $request->file("image")->storeAs("users", $imageName, 'public_user');
        }

        $user->update([
            'username' => $request->username,
            "email" => $request->email,
            "cash" => (float) $request->balance,
            "image" => $request->file("image") ? $path : $user->image,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index");
    }

    public function bulkDelete(Request $request)
    {
        User::destroy($request->products);
        return redirect()->route("users.index");
    }
}
