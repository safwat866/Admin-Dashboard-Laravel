<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nafezly\Payments\Classes\PaymobPayment;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $cartItems = Auth::user()->cartItems()->with("product")->get();
        $cartItemsJson = json_decode($cartItems, true);
        $user_balance = (float)$user->cash;

        $total = array_reduce($cartItemsJson, function ($carry, $item) {
            return $item["product"]["product_price"] + $carry;
        });

        if ($total > $user_balance) {
            return back()->withErrors(["balance" => "You Don't have Enought Balance!"]);
        }

    }
}
