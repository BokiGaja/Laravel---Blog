<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPostsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.index', ['user' => $user]);
    }
}
