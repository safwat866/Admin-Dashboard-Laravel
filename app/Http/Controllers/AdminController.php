<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function index() {
        $usersCount = count(User::all());
        $adminsCount = count(User::role('admin')->get());
        return view("pages.dashboard", compact('usersCount', "adminsCount"));
    }
}
