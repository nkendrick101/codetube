<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user) {
    	return  [
    		'id' => $user->id,
    		'name' => $user->name,
    		'image' => $user->channel()->first()->image,
    		'channel_name' => $user->channel()->first()->name
    	];
    }
}