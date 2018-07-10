<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index (Request $request, Channel $channel) {
    	if (optional($request->user())->id === $channel->user->id) {
    		return redirect()->to('/account/@' . auth()->user()->channel()->first()->slug . '/profile');
    	}

    	return view ('profile.index', [
    		'channel' => $channel,
    		'videos' => $channel->videos()->paginate(9)
    	]);
    }
}
