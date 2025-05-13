<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt($request->only('email', 'password'), (request()->input('remember')) ? true : false)) {
            return back()->withErrors([
                'email' => __('auth.failed'),
            ])->withInput();
        }

        request()->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
