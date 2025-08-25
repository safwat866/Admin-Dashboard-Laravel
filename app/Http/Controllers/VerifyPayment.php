<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Nafezly\Payments\Classes\PaymobPayment;

class VerifyPayment extends Controller
{
    public function handleCallback(Request $request)
    {
        $payment = new PaymobPayment();
        $result = $payment->verify($request);

        if ($result['success']) {

            $userId = Cookie::get('user_id');

            $user = User::where("id", $userId)->first();

            $user_balance = $user->cash;

            $availble_cash = $user_balance -($result["process_data"]["amount_cents"] / 100);

            $user->update([
                'cash' => $availble_cash,
            ]);

            Cart::where("user_id", $user->id)->delete();

            return redirect()->route("/", ['details' => $result]);

        } else {
           return view("pages.payment_failed");
        }
    }
}
