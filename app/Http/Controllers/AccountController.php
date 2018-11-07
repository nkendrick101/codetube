<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Card;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Controllers\CostumerController;

class AccountController extends Controller
{
  public function index (Request $request) {
    return view('account.index', [
      'user' => $request->user(),
      'section' => $request->section
    ]);
  }

  public function update (AccountUpdateRequest $request, Channel $channel) {
    if ($request->section === 'payment') {

      // create or update payment method
      $card = CardController::createOrUpdate([
        'customerId' => $request->user()->braintree_customer_id,
        'cardholderName' => $request->name,
        'number' => str_replace(' ', '', $request->number),
        'expirationDate' => str_replace(' ', '', $request->date),
        'cvv' => $request->cvv,
        'token' => $request->filled('token') ? $request->token : null,
      ]);

      // ensure payment method was successful 
      if (!$card->success || isset($card->message)) {
        $errors = new MessageBag();
        $braintreeErrorMessages = explode('. ', $card->message);

        $customErrorMessages = [
          'number' => [
            'Credit card number is invalid',
            'Duplicate card exists in the vault',
          ],
          'cvv' => [
            'CVV must be 4 digits for American Express and 3 digits for other card types',
          ]
        ];

        foreach ($customErrorMessages as $field => $customErrorMessage) {
          foreach ($braintreeErrorMessages as $braintreeErrorMessage) {
            foreach ($customErrorMessage as $message) {
              if ($message === str_replace('.', '', $braintreeErrorMessage)) {
                $errors->add($field, $message . '.');
              }
            }
          }
        }

        return redirect()->back()->withErrors($errors);
      }

      // update customer payment card
      if ($request->filled('token')) {
        Card::where('token', $request->token)->first()->update([
          'holder' => $request->name,
          'type' => $card->creditCard->cardType,
          'last4' => $card->creditCard->last4,
          'token' => $card->creditCard->token,
          'image' => $card->creditCard->imageUrl,
        ]);

        return redirect()->back()->with('status', 'Card updated.');
      }

      // else (at last) create newly payment card
      $request->user()->cards()->create([
        'customer_id' => $request->user()->braintree_customer_id,
        'holder' => $request->name,
        'type' => $card->creditCard->cardType,
        'last4' => $card->creditCard->last4,
        'token' => $card->creditCard->token,
        'image' => $card->creditCard->imageUrl,
      ]);

      return redirect()->back()->with('status', 'New card saved.');
    }

    else if ($request->section === 'settings') {
      $request->user()->setting()->update([
        'content_notification' => $request->content_notification === 'on' ? true : false,
        'password_notification' => $request->password_notification === 'on' ? true : false,
        'post_notification' => $request->post_notification === 'on' ? true : false,
        'topic_notification' => $request->topic_notification === 'on' ? true : false,
        'profile_visibility' => $request->profile_visibility === 'on' ? true : false,
        'email_notification' => $request->email_notification === 'on' ? true : false,
      ]);

      return redirect()->back()->with('status', 'Settings updated.');
    }

    else if ($request->section === 'password') {
      if (!Hash::check($request->password, $request->user()->password)) {
        $errors = new MessageBag();
        $errors->add('password', 'Invalid current password.');
        return redirect()->back()->withErrors($errors);
      }
      $request->user()->update(['password' => Hash::make($request->new_password)]);
      return redirect()->back()->with('status', 'Password updated.');
    } 
    
    else if ($request->section === 'channel') {
      $channel->first()->update([
        'name' => $request->channel_name,
        'description' => $request->channel_description,
      ]);
      return redirect()->back()->with('status', 'Channel updated.');
    }

    $request->user()->name = $request->name;
    $request->user()->facebook_id = $request->facebook_id;
    $request->user()->google_id = $request->google_id;
    $request->user()->twitter_id = $request->twitter_id;
    $request->user()->save();
    return redirect()->back()->with('status', 'Profile updated.');
  }
}
