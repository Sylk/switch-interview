<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function process(Request $request) {
        $checkout = $request->json()->get('checkout');
        $tendered = $request->json()->get('tendered');

        $remaining = $checkout;
        $change = [
            "hundreds" => 0,
            "fifties" => 0,
            "twenties" => 0,
            "tens" => 0,
            "fives" => 0,
            "ones" => 0,
            "quarters" => 0,
            "dimes" => 0,
            "nickles"=> 0,
            "pennies" => 0
        ];

        if($tendered < $checkout) {
            return response('Insufficient cash tendered to purchase item.', 400);
        }

        while($remaining > 0.00){
            if($remaining > 100 ) {
                $change["hundreds"] += 1;
                dd($change);
            } else if($remaining > 50) {

            } else if($remaining > 20) {

            } else if($remaining > 10) {

            } else if($remaining > 5) {

            } else if($remaining > 1) {

            } else if($remaining > 0.25) {

            } else if($remaining > 0.10) {

            } else if($remaining > 0.05) {

            } else if($remaining > 0.01) {

            } else {
                return response('Incorrect amount of cash.', 400);
            }
        }

        if($remaining+$checkout == $checkout) {
            return response($change, 200);

        } else {
            return response('Incorrect amount of cash.', 400);
        }

    }
}
