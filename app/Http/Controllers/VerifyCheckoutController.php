<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyCheckoutController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            abort(400, 'Missing session ID');
        }

        \Stripe\Stripe::setApiKey(env("STRIPE_API_KEY"));

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $status = $paymentIntent->status;
        $amount = $paymentIntent->amount / 100;
        $userBalance = Auth::user()->cash;

        if ($status === 'succeeded') {
            Auth::user()->update([
                'cash' => $userBalance - $amount,
            ]);

            // Orders::create([
            //     'user_id' => Auth::user()->id,
            //     'status' => 'paid',
            //     'amount' => a
            // ]);

            // empty the cart
            Cart::truncate();
            
            return redirect()->route("home");
        } else {
            return redirect()->route("home")->withErrors([
                "balance" => "error",
            ]);
        }

    }

}
