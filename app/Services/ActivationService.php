<?php

namespace App\Services;

use App\Models\User;
use Braintree\Customer;
use App\Notifications\EmailVerification;
use App\Repositories\ActivationRepository;

class ActivationService
{
  protected $activationRepo;
  protected $resendAfter = 24;

  public function __construct (ActivationRepository $activationRepo) {
    $this->activationRepo = $activationRepo;
  }

  public function sendActivationMail ($user) {
    if ($user->activated || !$this->shouldSend($user)) { 
      return; 
    }

    $token = $this->activationRepo->createActivation($user);
    $user->notify(new EmailVerification($token));
  }

  public function activateUser ($token) {
    $activation = $this->activationRepo->getActivationByToken($token);

    if ($activation === null) { 
      return null; 
    }

    $user = User::find($activation->user_id);
    $user->activated = true;

    // create a braintree customer and bind to this newly activated user
    $user->braintree_customer_id = Customer::create([
      'firstName' => strtok($user->name, ' '),
      'lastName' => strstr($user->name, ' '),
      'email' => $user->email
    ])->customer->id;

    // and finally set his/her settings
    $user->setting()->create([
      'content_notification' => true,
      'password_notification' => true,
      'reply_notification' => true,
      'profile_visibility' => true,
      'email_notification' => true
    ]);

    // and that's it
    $user->save();
    $this->activationRepo->deleteActivation($token);

    return $user;
  }

  private function shouldSend ($user) {
    $activation = $this->activationRepo->getActivation($user);
    return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
  }
}
