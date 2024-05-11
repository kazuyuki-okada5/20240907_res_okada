<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // User モデルをインポートする

class RepresentativeController extends Controller
{
    public function store(Request $request)
    {
        // バリデーションを追加
        $request->validate([
            'email' => 'required|email|unique:users,email',
            // 他のルールも追加可能
        ]);

        // ユーザーを作成
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'representative', // ロールを固定で設定
        ]);

        // 関連付ける店舗の ID を取得
        $storeId = $request->input('store_id');

        // ユーザーと店舗の関連付けを行う
        $user->stores()->attach($storeId);

        // リダイレクトなどの適切なレスポンスを返します
        return redirect()->route('home')->with('success', 'Representative created successfully!');
    }
}

