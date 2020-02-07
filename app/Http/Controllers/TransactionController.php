<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function process(Request $request) {
        $checkout = $request->json()->get('checkout');
        $tendered = $request->json()->get('tendered');
        
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

//      Add validation for data type to be double
        else if($tendered < $checkout) {
            return response('Insufficient cash tendered to purchase item.', 400);
        }
        else if($tendered == null || $checkout == null) {
            return response('A null amount has been provided, please fix it before posting again.', 400);
        }

        $tendered = $tendered - $checkout;

        while($tendered > 0.009){
            if($tendered >= 100 ) {
                $tendered -= 100;
                $change["hundreds"] += 1;
            } else if($tendered >= 50) {
                $tendered -= 50;
                $change["fifties"] += 1;
            } else if($tendered >= 20) {
                $tendered -= 20;
                $change["twenties"] += 1;
            } else if($tendered >= 10) {
                $tendered -= 10;
                $change["tens"] += 1;
            } else if($tendered >= 5) {
                $tendered -= 5;
                $change["fives"] += 1;
            } else if($tendered >= 1) {
                $tendered -= 1;
                $change["ones"] += 1;
            } else if($tendered >= 0.25) {
                $tendered -= 0.25;
                $change["quarters"] += 1;
            } else if($tendered >= 0.10) {
                $tendered -= 0.1;
                $change["dimes"] += 1;
            } else if($tendered >= 0.05) {
                $tendered -= 0.05;
                $change["nickels"] += 1;
            } else if($tendered >= 0.01) {
                $tendered -= 0.01;
                $change["pennies"] += 1;
            }
        }

        $tendered = number_format($tendered, 2, '.', '');

        if($tendered == 0) {
            return response($change, 200);

        } else {
            return response('Incorrect amount of cash.', 400);
        }

    }
}
