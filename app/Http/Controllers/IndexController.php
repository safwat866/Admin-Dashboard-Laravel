<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function index()
    {
        // fetch the products
        $products = Products::all();

        // fetch cart items
        $cartItems = Auth::user()->cartItems;

        return view("pages.index", compact("products", "cartItems"));
    }
}