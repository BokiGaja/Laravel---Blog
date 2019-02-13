<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect('/posts');
    }

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
        ]);
        // Login, attempt will try to login with credentials (email, password)
        if (!auth()->attempt($request->only(['email', 'password'])))
        {
            return back()->withErrors([
                'message' => 'Wrong login credentials!'
            ]);
        }
        return redirect()->route('home');
    }
}
