<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid email or password.',
                ], 422);
            }

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $redirectUrl = '/admin/dashboard';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'route' => $redirectUrl,
            ]);
        }

        return redirect()->intended($redirectUrl);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'route' => '/login',
            ]);
        }

        return redirect('/login');
    }
}
