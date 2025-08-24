<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request) {
        $user = User::where("id", $request->id)->first();
        $cart_items = Cart::where("user_id", $user->id)->with("product")->get();
        $cart_items_json = json_decode($cart_items, true);
        $total = array_reduce($cart_items_json, function($carry, $item) {
            return $carry + $item["product"]["product_price"];
        });

        $user_balance = $user->cash;

        if ($total > $user_balance) {
            return back()->withErrors(["balance" => "You Don't have Enought Balance!"]);
        }
        
        $availble_cash = $user_balance - $total;

        $user->update([
            'cash' => $availble_cash,
        ]);

        Cart::where("user_id", $request->id)->delete();

        return redirect()->route('/');
    }
}
