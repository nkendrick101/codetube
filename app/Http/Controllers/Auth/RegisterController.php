<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ActivationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';
    protected $activationService;

    public function __construct(ActivationService $activationService) 
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->activationService = $activationService;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->channel()->create([
            'name' => $data['channel_name'],
            'slug' => uniqid(true),
        ]);

        return $user;
    }

    public function register(Request $request) 
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $user = $this->create($request->all());
        $this->activationService->sendActivationMail($user);
        return redirect('login')->with('notification', 'We\'ve sent you an activation code. Please check your email for confirmation.');
    }
}