<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use App\Http\Requests\SendMessageRequest;

class ContactController extends Controller
{
    public function send(SendMessageRequest $request) {
    	$message = [
			'name' => $request->message_name,
			'email' => $request->message_email,
			'body' => $request->message_body,
		];

		try {
    		Mail::to(config('app.email'))->send(new ContactMessage($message));
    	} catch (\Exception $err) {
    		return redirect()->back()->with('message_response', 'error');
    	}

   		return redirect()->back()->with('message_response', 'success');
    }
}
