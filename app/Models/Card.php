<?php

namespace App\Models;

use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	use Searchable; 
	
	protected $fillable = [
		'customer_id',
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
