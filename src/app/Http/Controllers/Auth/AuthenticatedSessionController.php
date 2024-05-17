<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // ログインビューを表示する
        return view('auth.login');
    }
    
    /**
     * Attempt to authenticate the user.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 入力値の検証
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ユーザー認証を試みる
        if (Auth::attempt($request->only('email', 'password'))) {
            // 認証成功時の処理
            $request->session()->regenerate(); // セッションを再生成
            return redirect('/stores'); // '/stores'ページにリダイレクト
        }

        // 認証失敗時の処理
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // ユーザーをログアウトし、セッションを無効化して新しいCSRFトークンを生成する
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウト後に'/stores'ページにリダイレクトする
        return redirect('/stores');
    }
}

