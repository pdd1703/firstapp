<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Validator;
class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }
    function registration()
    {
        return view('registration');
    }
    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }
    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Registration successful");
    }
    function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
