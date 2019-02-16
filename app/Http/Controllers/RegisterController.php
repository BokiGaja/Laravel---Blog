<?php

namespace App\Http\Controllers;
use App\Services\AuthService;
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
        AuthService::register($request);
        return redirect()->route('home');

    }
}
