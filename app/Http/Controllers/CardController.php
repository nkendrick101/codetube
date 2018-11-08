<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Braintree\CreditCard;
use Illuminate\Http\Request;
use App\Transformers\CardTransformer;

class CardController extends Controller
{
  public function getCards (Request $request) {
    if (!$request->ajax()) {
      abort(404);
    }

    $cardTokens = $request->user()->cards()->latestFirst()->select('token')->get();
    $cards = [];

    foreach ($cardTokens as $result) {
      if ($card = CreditCard::find($result->token)) {
        array_push($cards, $card);
      }
    }

    return response()->json(fractal()->collection($cards)
      ->transformWith(new CardTransformer)
      ->toArray()
    );
  }

  public function getCard (Request $request) {
    if (!$request->ajax()) {
      abort(404);      
    }

    $card = Card::where('token', $request->token)->firstOrFail();
    $braintreeCard = CreditCard::find($card->token);

    return response()->json([
      'number' => $braintreeCard->maskedNumber,
      'holder' => $braintreeCard->cardholderName,
      'date' => $braintreeCard->expirationDate,
      'cvv' => '***',
      'type' => $braintreeCard->cardType === 'American Express' ? 'Amex' : $braintreeCard->cardType,
      'token' => $braintreeCard->token,
    ], 200);
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
    if (!$request->ajax()) {
      abort(404);
    }

    $card = Card::where('token', $request->token)->firstOrFail();

    try {
      $result = CreditCard::delete($card->token);
    } catch (Exception $e) {
      return response()->json(['error' => 'Sorry, we were unable delete your payment method.']);
    }

    if ($result->success) {
      $card->delete();
      return response()->json(['status' => 'Credit card deleted with success.']);
    }
  }
}
