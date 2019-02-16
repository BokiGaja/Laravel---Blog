<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
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
        AuthService::login($request);
        return redirect()->route('home');
    }
}
