<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;


class StripeController extends Controller
{
    public function stripe(Request $request)
{
    //dd($request->all());
    // $stripeData = $request->query('stripe');
    // $decodedStripeData = json_decode(urldecode($stripeData));
    // dd($decodedStripeData);
    return view('frontend.stripe');
}
    public function stripePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        // Session::flash('success', 'Payment successful!');

        return back();
    }


    }
