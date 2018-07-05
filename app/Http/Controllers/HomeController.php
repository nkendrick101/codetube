<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        return view('home', [
        	'videos' => Video::all(),
        	'videos_processing' => Video::select('uuid')->where('processed', 0)->get()
        ]);
    }
}
