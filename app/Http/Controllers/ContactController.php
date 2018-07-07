<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send (Request $request) {
    	return response()->json($request->all(), 200);
    }
}
