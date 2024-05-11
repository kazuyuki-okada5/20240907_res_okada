<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ユーザーがログインしているかどうかを確認
        if (Auth::check()) {
            // ユーザーのロールが"manager"かどうかを確認
            if (Auth::user()->role === 'manager') {
                // "manager"のロールを持っている場合は、リクエストを次のミドルウェアやコントローラーに渡す
                return $next($request);
            } else {
                // "manager"のロールを持っていない場合は、リダイレクトやエラーページの表示などを行う
                return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
            }
        } else {
            // ログインしていない場合は、ログインページにリダイレクトするなどの処理を行う
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
    }
}

