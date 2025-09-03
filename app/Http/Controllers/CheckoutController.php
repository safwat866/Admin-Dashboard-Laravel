<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // fetch user data and cart products
        $user = Auth::user();
        $user_balance = (float) $user->cash;
        $cartItems = Auth::user()->cartItems()->with("product")->get();
        $cartItemsJson = json_decode($cartItems, true);

        $total = array_reduce($cartItemsJson, function ($carry, $item) {
            return $item["product"]["product_price"] + $carry;
        });

        // check if cart is empty
        if ($total == 0) {
            return redirect()->route("home");
        }

        // check if user don't have enough credit
        if ($total > $user_balance) {
            return back()->withErrors(["balance" => "You Don't have Enought Balance!"]);
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item["product"]["product_name"],
                    ],
                    'unit_amount' => (float) $item["product"]["product_price"] * 100,
                ],
                'quantity' => 1,
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route("verify-checkout", [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route("verify-checkout", [], true) . '?session_id={CHECKOUT_SESSION_ID}',
        ]);

        return redirect($session->url);
    }
}
