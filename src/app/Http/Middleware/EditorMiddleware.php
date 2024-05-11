<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ミドルウェアの処理を記述する
        
        return $next($request);
    }
}