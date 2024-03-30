<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Destroy an authenticated session.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout(); //ユーザーをログアウトする
        $request->session()->invalidate(); //セッションを無効にする
        $request->session()->regenerateToken(); //新しいCSRFトークンを生成する

        return redirect('/'); //ログアウト後に'/'ページにリダイレクトする
    }
}
