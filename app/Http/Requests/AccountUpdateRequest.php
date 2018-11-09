<?php

namespace App\Http\Requests;

use URL;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
{
  public function authorize () {
    return true;
  }

  public function rules () {
    $user_id = Auth::user()->id;
    $section = array_values(array_slice(explode('/', URL::previous()), -1))[0];

    if ($section === 'profile') {
      return [
        'name' => 'required|max:255',
      ];
    }
    else if ($section === 'payment') {
      return [
        'number' => 'required',
        'name' => 'required|string',
        'date' => 'required',
        'cvv' => 'required'
      ];
    }
    else if ($section === 'password') {
      return [
        'password' => 'bail|required|min:6',
        'new_password' => 'required|min:6|confirmed',
        'new_password_confirmation' => 'required|min:6'
      ];
    } 
    else if ($section === 'channel') {
      return [
        'channel_name' => 'required|alpha_num|max:255|unique:channels,name,' . $user_id,
        'channel_description' => 'nullable|min:6|max:500'
      ];
    }
    else if ($section === 'settings') {
      return [];
    }

    abort(404);
  }
}
