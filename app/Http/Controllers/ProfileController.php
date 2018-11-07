<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function index (Request $request, Channel $channel) {
    return view ('profile.index', [
      'channel' => $channel,
      'videos' => $channel->videos()->paginate(9)
    ]);
  }
}
