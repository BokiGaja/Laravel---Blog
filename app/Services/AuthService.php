<?php
/**
 * Created by PhpStorm.
 * User: nemanjagajic
 * Date: 2/15/19
 * Time: 9:55 PM
 */

namespace App\Services;


use App\User;

class AuthService
{
    public static function login($loginData)
    {
        $loginData->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Login, attempt will try to login with credentials (email, password)
        if (!auth()->attempt($loginData->only(['email', 'password'])))
        {
            return false;
        }
        return true;
    }

    public static function register($registerData)
    {
        // Validation
        $registerData->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'age' => 'required|integer|min:1'
        ]);
        $data = $registerData->only([
            'email', 'name', 'password'
        ]);
        // Encryption with bcrypt helper
        $data['password'] = bcrypt($data['password']);
        // Creation
        $user = User::create($data);
        // Login user
        auth()->login($user);
    }
}