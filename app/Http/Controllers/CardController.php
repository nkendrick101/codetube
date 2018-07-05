<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Braintree\CreditCard;
use Illuminate\Http\Request;
use App\Transformers\CardTransformer;

class CardController extends Controller
{
    public function getCards (Request $request) {
    	return response()->json(
            fractal()->collection($request->user()->cards()->latestFirst()->get())
                ->transformWith(new CardTransformer)
                ->toArray()
        );
    }

    public function getCard (Request $request) {
        $card = Card::where('token', $request->token)->firstOrFail();

        if ($request->ajax()) {
            $braintreeCard = CreditCard::find($card->token);

            return response()->json([
                'number' => $braintreeCard->maskedNumber,
                'holder' => $card->holder,
                'date' => $braintreeCard->expirationDate,
                'cvv' => '***',
                'type' => $card->type,
                'token' => $card->token,
            ], 200);
        }

        abort(401);
    }

    public static function createOrUpdate ($card) {
        if ($card['token']) {
            return CreditCard::update($card['token'], [
                'cardholderName' => $card['cardholderName'],
                'number' => $card['number'],
                'expirationDate' => $card['expirationDate'],
                'cvv' => $card['cvv'],
                'options' => [
                    'makeDefault' => true,
                    'verifyCard' => true,
                    'failOnDuplicatePaymentMethod' => true,
                ]
            ]);
        }

        return CreditCard::create([
            'customerId' => $card['customerId'],
            'cardholderName' => $card['cardholderName'],
            'number' => $card['number'],
            'expirationDate' => $card['expirationDate'],
            'cvv' => $card['cvv'],
            'options' => [
                'makeDefault' => true,
                'verifyCard' => true,
                'failOnDuplicatePaymentMethod' => true,
            ]
        ]);
    }

    public function delete (Request $request) {
        $card = Card::where('token', $request->token)->firstOrFail();

        try {
            $result = CreditCard::delete($card->token);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry, we were unable delete your payment method.');
        }

        if ($result->success) {
            $card->delete();
            return redirect()->back()->with('status', 'Credit card deleted with success.');
        }
    }
}
