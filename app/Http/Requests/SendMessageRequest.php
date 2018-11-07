<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
  public function authorize () {
    return true;
  }

  public function rules () {
    return [
      'message_name' => 'required|string|max:255',
      'message_email' => 'required|email|max:255',
      'message_body' => 'required|max:1000'
    ];
  }
}
