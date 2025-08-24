<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function showProducts() {
        // get user data
        $userId = Cookie::get('user_id');
        $user = User::where("id", $userId)->first();

        // get products
        $products = Products::all();

        //get cart
        $cart = Cart::where("user_id", $userId)->with('product')->get();

        return view("pages.index", [
            "user" => $user,
            "products" => $products,
            "cart" => $cart,
        ]);
    }
}