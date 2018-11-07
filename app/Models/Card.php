<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
  protected $fillable = [
    'holder',
    'type',
    'last4',
    'token',
    'image',
  ];

  public function user () {
    return $this->belongsTo(User::class);
  }

  public function getRouteKeyName () {
    return 'token';
  }

  public function scopelatestFirst ($query)  {
    return $query->orderBy('created_at', 'DESC');
  }
}
