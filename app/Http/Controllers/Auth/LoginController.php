<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (empty($credentials['email']) || empty($credentials['password'])) {
            return back()->withErrors([
                'email' => 'Please enter your email and password.',
            ]);
        }

        session()->put('user_logged_in', true);
        session()->put('user_email', $credentials['email']);

        return redirect()->route('tasks.index')->with('success', 'Welcome back!');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        session()->put('registered_name', $data['name']);
        session()->put('registered_email', $data['email']);

        return redirect()->route('login')->with('success', 'Your account was created. Please log in.');
    }

    public function logout()
    {
        session()->forget('user_logged_in');
        session()->forget('user_email');

        return redirect()->route('login');
    }
}
