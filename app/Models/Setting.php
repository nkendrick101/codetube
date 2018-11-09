<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $fillable = [
    'content_notification',
    'password_notification',
    'reply_notification',
    'profile_visibility',
    'email_notification'
  ];

  public function user () {
    return $this->belongsTo(User::class);
  }
}
