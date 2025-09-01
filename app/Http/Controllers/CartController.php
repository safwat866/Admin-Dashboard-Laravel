<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'exists:products',
        ]);

        Cart::create([
            'user_id' => $request->user,
            'product_id' => $request->product,
        ]);

        return redirect()->route("home");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('home');
    }
}
