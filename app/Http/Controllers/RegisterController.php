<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $data = $request->only([
            'email', 'name', 'password'
        ]);
        // Encryption with bcrypt helper
        $data['password'] = bcrypt($data['password']);
        // Creation
        $user = User::create($data);
        // Login user
        auth()->login($user);
        return redirect()->route('home');

    }
}
