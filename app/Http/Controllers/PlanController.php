<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Card;
use Braintree\CreditCard;
use Illuminate\Http\Request;
use App\Http\Requests\PlanSubscriptionRequest;

class PlanController extends Controller
{
    public function index (Request $request) {
    	$cards = [];
        $tokens = Card::where('user_id', $request->user()->id)->pluck('token')->toArray();

        if (count($tokens) !== 0) {
            foreach($tokens as $token) {
                $cards[] = CreditCard::find($token);
            }
        }

    	//return response()->json($cards);

    	return view ('plans.index', [
    		'plans' => Plan::get(),
    		'user' => $request->user(),
    		'cards' => $cards
    	]);
    }

    public function subscribe (PlanSubscriptionRequest $request) {
    	return;
    }
}
