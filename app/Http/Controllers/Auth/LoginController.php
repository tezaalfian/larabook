<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credential, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
