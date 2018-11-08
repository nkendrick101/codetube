<?php

namespace App\Http\Controllers;

use Braintree_ClientToken;
use Illuminate\Http\Request;

class BraintreeTokenController extends Controller
{
  public function token(Request $request)
  {
    return response()->json([
      'token' => Braintree_ClientToken::generate(),
    ]);
  }
}
