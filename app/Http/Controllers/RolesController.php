<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table("roles")->get();
        return view("pages.roles", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->can("edit roles")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        $permissions = DB::table("permissions")->get();
        return view("pages.add_role", compact( "permissions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can("edit roles")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route("roles.index");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user()->can("edit roles")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        $role = Role::find($id);
        $permissions = DB::table("permissions")->get();
        $rolePermissions = $role->permissions;
        return view("pages.edit_roles", compact('role', "permissions", "rolePermissions"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->can("edit roles")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->can("edit roles")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        
        $role = Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            return back()->withErrors(['permession' => 'Cannot delete role. It is assigned to user.']);
        } else {
            $role->delete();
            return redirect()->route("roles.index");
        }
    }
}
