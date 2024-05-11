<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store; // Storeモデルを使用するためにインポート
use App\Models\User; // 追加
use App\Models\Representative; // 追加

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // このコントローラーの全てのアクションに対して認証を確認する
    }

    public function index()
    {
        // ログイン中のユーザーを取得
        $user = Auth::user();

        // ユーザーがマネージャーであるかどうかをチェック
        if ($user && $user->hasRole('manager')) {
            // マネージャー向けの処理を記述

            // 店舗データを取得
            $stores = Store::all();

            // ビューに店舗データを渡す
            return view('manager.home', ['stores' => $stores]);
        } else {
            // マネージャー以外の場合はリダイレクトなどの処理を記述
            return redirect('/'); // 適切なリダイレクト先に変更する
        }
    }

    // 店舗情報を取得するメソッドを追加
    public function getStores()
    {
        $stores = Store::all(); // Storeモデルからすべての店舗情報を取得
        return $stores;
    }

        public function home()
    {
        // 店舗代表者のデータを取得
        $representatives = User::where('role', 'representative')->get();
        // 店舗のデータを取得
    $stores = Store::all(); // 実際の取得方法に応じて変更してください


        // 他の必要なデータの取得や処理もここで行う

        // ビューにデータを渡す
        return view('manager.home', compact('representatives', 'stores'));
    }

    
}


