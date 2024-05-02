<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthRepresentativeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.representative_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('representative')->attempt($credentials)) {
            return redirect()->route('edit_main');
        }

        return redirect()->route('login.representative')->withErrors(['email' => '認証に失敗しました。']);
    }
}